#include <ArduinoJson.h>
#include <ESP8266WiFi.h>
#include <WiFiClientSecure.h>
#include <SoftwareSerial.h>
#include <Wire.h>
#include <Keypad.h>
#include <LiquidCrystal_I2C.h>
#include <ESP8266HTTPClient.h>


/* Init the LCD*/
LiquidCrystal_I2C lcd(0x27, 20, 4);
/*Init the RFID data structure*/
const int BUFFER_SIZE = 14; // RFID DATA FRAME FORMAT: 1byte head (value: 2), 10byte data (2byte version + 8byte tag), 2byte checksum, 1byte tail (value: 3)
const int DATA_SIZE = 10; // 10byte data (2byte version + 8byte tag)
const int DATA_VERSION_SIZE = 2; // 2byte version (actual meaning of these two bytes may vary)
const int DATA_TAG_SIZE = 8; // 8byte tag
const int CHECKSUM_SIZE = 2; // 2byte checksum
SoftwareSerial ssrfid = SoftwareSerial(13,10); 
uint8_t buffer[BUFFER_SIZE]; // used to store an incoming data frame 
int buffer_index = 0;
/*Init the keypad */
const byte numRows= 4;

const byte numCols= 4;

char keymap[numRows][numCols]= {
{'1', '2', '3', 'A'},

{'4', '5', '6', 'B'},

{'7', '8', '9', 'C'},

{'*', '0', '#', 'D'} };
String number="";
byte rowPins[numRows] = {0,2,14,12}; //Rows 0 to 3

byte colPins[numCols]= {15,3,1,10}; //Columns 0 to 3

//initializes an instance of the Keypad class

Keypad myKeypad= Keypad(makeKeymap(keymap), rowPins, colPins, numRows, numCols);

const char* ssid = "PKOVER_Wifi";   
const char* password = "0378911202";

long tag;
long money=1000;
long pre_tag=0;
long staff_tag=0;;
long user_tag=0;
long result=0;
String staff_tagString,user_tagString,moneyString;
//--------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------
void setup() {
  //Init RDM6300
  Serial.begin(9600);
 ssrfid.begin(9600);
 ssrfid.listen(); 
 pinMode(D0,OUTPUT);
 //Init LCD
 Wire.begin(D2,D1);
  lcd.begin();   // initializing the LCD
  lcd.backlight(); // Enable or Turn On the backlight 
  //Init wifi
  lcd.print("Connecting...");
  lcd.setCursor(0,1);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid,password);
   while (WiFi.status() != WL_CONNECTED) { //Thoát ra khỏi vòng 
        delay(500);
        lcd.print('.');
    }
  lcd.clear();
  lcd.print("Wifi connected");
  lcd.setCursor(0,1);
  lcd.print("Da ket noi WiFi");
  lcd.setCursor(0,2);
  lcd.print("IP: ");
  lcd.print(WiFi.localIP());
  delay(1000);     
}

//--------------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------
void loop(){
  char option;
  //Define Arduinojson Object
  StaticJsonBuffer<200> jsonBuffer;
  JsonObject& root=jsonBuffer.createObject();
  
  lcd.clear();                                    //Home
  if (staff_tag==0) lcd.print("A -> login ");     //
  else lcd.print("A -> logout ");                 // 
  lcd.setCursor(0,1);                             //
  lcd.print("B -> pay ");                         //
  lcd.setCursor(0,2);                             //
  lcd.print("C -> change money ");  
  lcd.setCursor(0,3); 
  //lcd.print("D -> add card");                     //
  for(int i=1;i>0;i++){           //
    option=myKeypad.getKey();   //
    delay(50);                       //Wait for option key
    if (option!=NO_KEY){             //
      lcd.clear(); break;            //
    }
  }
  //----------------------------------------------------------------------------------------------------------------------------------------
// Log in staffID
  if(option=='A') {
    if (staff_tag==0) login(); else logout();
    return;
  }

  //-------------------------------------------------------------------------------------------------------------------------------
// Make transaction
  if(option=='B'){
    if(staff_tag==0){
      lcd.print("No staff ID: ");
      delay(3000);
      return;
    }
    else{
 //read userID
      lcd.clear();
      lcd.print("Money: "); lcd.print(money);
      lcd.setCursor(0,1);
      lcd.print("Scan card... ");
      user_tag=0;
      int i = 0;
      while(user_tag==0 && i<5) {
        i++;
        user_tag=readTag2();
      }
      if (i>=5) {
        user_tag = tag;
      }
      lcd.clear();
      lcd.print("User ID: ");
      lcd.setCursor(0,1);
      lcd.print(user_tag);
      delay(1000);
      lcd.clear();
//Make a Json String
      staff_tagString=String(staff_tag);
      user_tagString=String(user_tag);
      moneyString=String(money);
      root["secret_key"]="cb08ca4a7bb5f9683c19133a84872ca7";
      root["id_pay_member"]=user_tagString;
      root["id_collect_member"]=staff_tagString;
      root["amountofmoney"]=moneyString;

      String postData;
      root.printTo(postData);
//Make a http post request 
       HTTPClient http; //Declare httpClient Object
       http.begin("http://192.168.43.241:10110/transaction/add");              //Specify request destination

       http.addHeader("Content-Type", "application/json");    //Specify content-type header
       
       int httpCode = http.POST(postData);   //Send the request
       //delay(2000);
     
       String respone = http.getString();    //Get the response payload
      
       jsonBuffer.clear();
       http.end();  //Close connection
  //Parse the respone
    StaticJsonBuffer<400> re_jsonBuffer;
       JsonObject& Res = re_jsonBuffer.parseObject(respone);
       const char *  payment_message=Res["message"];
      // Payment status
      
        digitalWrite(D0,HIGH); delay(100);
        digitalWrite(D0,LOW);
      
      lcd.print(payment_message);
     //Wait for pressing any key
    for(int i=1;i<30000;i++){
      delay(50);
      if(myKeypad.getKey()!=NO_KEY) break;
    }
    re_jsonBuffer.clear();
      return;
    }
  }
  //-------------------------------------------------------------------------------------------------------
  if(option=='C'){
       money=readMoney();
  }
  //----------------------------------------------------------------------------------------------------------------------------------------
//add card
/*  if(option=='D'){
    if(staff_tag==0){
      lcd.print("No staff ID: ");
      delay(3000);
      return;
    }
    else{
 //read userID
      lcd.clear();
      lcd.print("Scan card... ");
      user_tag=0;
      int i = 0;
      while(user_tag==0 && i<5) {
        i++;
        user_tag=readTag2();
      }
      if (i>=5) {
        user_tag = tag;
      }
      digitalWrite(D0,HIGH); delay(100);
      digitalWrite(D0,LOW);
      lcd.clear();
      lcd.print("User ID: ");
      lcd.setCursor(0,1);
      lcd.print(user_tag);
      delay(1000);
      lcd.clear();
//Make a Json String
      staff_tagString=String(staff_tag);
      user_tagString=String(user_tag);
      root["id_card"]=user_tagString;
      root["id_collect_member"]=staff_tagString;

      String postData;
      root.printTo(postData);
//Make a http post request 
       HTTPClient http; //Declare httpClient Object
       http.begin("http://192.168.137.1:10110/card/add");              //Specify request destination

       http.addHeader("Content-Type", "application/json");    //Specify content-type header
       
       int httpCode = http.POST(postData);   //Send the request
       //delay(2000);
     
       String respone = http.getString();    //Get the response payload
       
       jsonBuffer.clear();
       http.end();  //Close connection
  //Parse the respone
    StaticJsonBuffer<400> re_jsonBuffer;
       JsonObject& Res = re_jsonBuffer.parseObject(respone);
       const char *  payment_message=Res["message"];
      // Payment status
      if (strcmp(payment_message,"Done")){
        digitalWrite(D0,HIGH); delay(100);
        digitalWrite(D0,LOW);
      }
     lcd.print(payment_message);
     //Wait for pressing any key
    for(int i=1;i<30000;i++){
      delay(50);
      if(myKeypad.getKey()!=NO_KEY) break;
    }
      re_jsonBuffer.clear();
      return;
    }
  }*/
}

//------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------
long readTag2(){
  tag=readTag();
  if(pre_tag!=tag) { 
    pre_tag=tag; return tag;
  }
  else {pre_tag=tag; return 0;}
}
long readTag() {
 fflush(stdin);
 for(int i=1;i>0;i++){
  delay(100);
  if(ssrfid.available()>0) break;
 }
 while(true){
  if (ssrfid.available() > 0){
    bool call_extract_tag = false;
    
    int ssvalue = ssrfid.read(); // read 
    if (ssvalue == -1) { // no data was read
      continue;
    }
    if (ssvalue == 2) { // RDM630/RDM6300 found a tag => tag incoming 
      buffer_index = 0;
    } else if (ssvalue == 3) { // tag has been fully transmitted       
      call_extract_tag = true; // extract tag at the end of the function call
    }
    if (buffer_index >= BUFFER_SIZE) { // checking for a buffer overflow (It's very unlikely that an buffer overflow comes up!)
      Serial.println("Error: Buffer overflow detected!");
      continue;
    }
    
    buffer[buffer_index++] = ssvalue; // everything is alright => copy current value to buffer
    if (call_extract_tag == true) {
      if (buffer_index == BUFFER_SIZE) {
        unsigned tag_x = extract_tag();
        buffer_index = 0;
        return tag_x;
      } else { // something is wrong... start again looking for preamble (value: 2)
        buffer_index = 0;
        continue;
      }
    }    
   }    
  }
}
unsigned extract_tag() {
    uint8_t msg_head = buffer[0];
    uint8_t *msg_data = buffer + 1; // 10 byte => data contains 2byte version + 8byte tag
    uint8_t *msg_data_version = msg_data;
    uint8_t *msg_data_tag = msg_data + 2;
    uint8_t *msg_checksum = buffer + 11; // 2 byte
    uint8_t msg_tail = buffer[13];
    long tag_x = hexstr_to_value(msg_data_tag, DATA_TAG_SIZE);
    return tag_x;
}
long hexstr_to_value(uint8_t *str, unsigned int length) { // converts a hexadecimal value (encoded as ASCII string) to a numeric value
  char* copy = (char*)malloc((sizeof(char) * length) + 1); 
  for(int i=0;i<length;i++) copy[i]=char(str[i]);
  copy[length] = '\0'; 
  // the variable "copy" is a copy of the parameter "str". "copy" has an additional '\0' element to make sure that "str" is null-terminated.
  long value = strtol(copy, NULL, 16);  // strtol converts a null-terminated string to a long value
  free(copy); // clean up 
  return value;
}
void login(){
  lcd.clear();
  lcd.print("Login...");
  int i = 0;
  while(staff_tag==0 && i<5) {
    i++;
    staff_tag=readTag2(); 
  }
  if (i>=5) {
    staff_tag = tag;
  }
  digitalWrite(D0,HIGH); delay(100);
  digitalWrite(D0,LOW);
  lcd.clear();
  lcd.print("Staff_ID: ");
  lcd.setCursor(0,1);
  lcd.print(staff_tag);
  delay(2000);
}

void logout(){
  lcd.clear();
  staff_tag = 0;
  lcd.print("logout...");
  delay(2000);
}

long readMoney(){
  lcd.clear();
  lcd.print("Enter Money...");
  lcd.setCursor(0,1);
  lcd.print(money);
  long m = 0;
  for(int i=1;i>0;i++){
    char key=myKeypad.getKey();   
    if(key!=NO_KEY) {
      if (key=='D'){
        if (m!=0){
          return m;
        }
        else {
          return money;
        }
      }
      else if(key=='#'){
        m = m/10;
        lcd.clear();
        lcd.print(m);
      }
      else if(key!='A' && key!='B' && key!='C'&&key!='*') {
        m = m*10+long(key)-48;
        lcd.clear();
        lcd.print(m);
      }
    }
    delay(50);
  }
}
