#!/usr/bin/env python
# -*- coding: utf-8 -*-


import signal
from module.MFRC522 import MFRC522
from module.pinos import PinoControle
import time
import socket


import RPi.GPIO as GPIO
GPIO.setmode(GPIO.BCM)  #Dat che do chan la BCM
GPIO.setup(02,GPIO.OUT) #LED  IF READ SUCCESS (LED GREEN)
GPIO.setup(03,GPIO.OUT) #LED IF PASS (LED WHITE)
GPIO.setup(04,GPIO.OUT) #BUZZER
GPIO.setup(17,GPIO.OUT) #LED if  false because more than 2 times(LED YELLOW)
GPIO.setup(27,GPIO.OUT) #LED if false because fail class (LED RED)


GPIO.output(04,GPIO.HIGH) #set default for buzzer

##from MFRC522 import MFRC522
##from pinos import PinoControle

class Nfc522(object):
    
    pc = PinoControle()
    MIFAREReader = None
    RST1 = 22 #GPIO
    RST2 = 22 #GPIO
    SPI_DEV0 = '/dev/spidev0.0'
    SPI_DEV1 = '/dev/spidev0.1'
    
    def obtem_nfc_rfid(self, autenticacao=False):
        try:
            self.MIFAREReader = MFRC522(self.RST1, self.SPI_DEV0)
##            while True:
            (status, TagType) = self.MIFAREReader.MFRC522_Request(self.MIFAREReader.PICC_REQIDL)
            (status, uid) = self.MIFAREReader.MFRC522_Anticoll()
            
            if status == self.MIFAREReader.MI_OK:
##                print "Ganesh 1"
                gid1 =  self.obtem_tag(self.MIFAREReader, status, uid, autenticacao)
##                    return gg
##                print "GID1:" + str(gg)
            else:
                self.pc.atualiza(self.RST1, self.pc.baixo())
##                print "GID1: No"

                gid1 = 0
            
        except Exception as e:
            print e
            
        try:    
            self.MIFAREReader = MFRC522(self.RST2, self.SPI_DEV1)
            
            
            #while True:
            (status, TagType) = self.MIFAREReader.MFRC522_Request(self.MIFAREReader.PICC_REQIDL)
            (status, uid) = self.MIFAREReader.MFRC522_Anticoll()
                
            if status == self.MIFAREReader.MI_OK:
                
                gid2= self.obtem_tag(self.MIFAREReader, status, uid, autenticacao)
##                print "GID2:" + str(ggg)
            else:
                self.pc.atualiza(self.RST2, self.pc.baixo())
##                print "GID2: No"
                gid2=0
##                    return None
            

        except Exception as e:
            print e
        #finally:
            #self.MIFAREReader.fecha_spi()

        return gid1,gid2
			
    def obtem_tag(self, MIFAREReader, status, uid, autenticacao):
        try:
			if autenticacao:
				#Khoa mac dinh de xac thuc
				key = [0xFF,0xFF,0xFF,0xFF,0xFF,0xFF]
				MIFAREReader.MFRC522_SelectTag(uid)
				status = MIFAREReader.MFRC522_Auth(MIFAREReader.PICC_AUTHENT1A, 8, key, uid)
				if status == MIFAREReader.MI_OK:
					MIFAREReader.MFRC522_Read(8)
					MIFAREReader.MFRC522_StopCrypto1()
				else:
					print "Loi xac thuc!"
					return None
			tag_hexa = ''.join([str(hex(x)[2:4]).zfill(2) for x in uid[:-1][::-1]]) #Returns in hexadecimal
			return int(tag_hexa.upper(), 16) #Returns in decimal
        except Exception as e:
            print e
			
# Capture SIGINT for cleanup when the script is aborted
def end_read(signal,frame):
    global continue_reading
    print "Nhan duoc tin hieu ngat Ctrl + C, dung doc!"
    continue_reading = False
#    GPIO.cleanup()

# Hook the SIGINT
signal.signal(signal.SIGINT, end_read)

nfc = Nfc522()

continue_reading = True
print "\nDua the vao dau doc\n---------------"

#Khai báo đối tượng socket
client = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
host = "192.168.43.233"
client.connect((host, 2000))

while continue_reading:
    print_opt = 0
    
    gid1,gid2 = nfc.obtem_nfc_rfid()
    ##print "G Read TAG Number: " +str(id)

    if not gid1==0:
        print "UID: " + str(gid1)+"\n-----*&*------\n"
        try:
            message = str(gid1)+"_192.168.43.148"
	    print(message)
            client.sendall(message.encode('ascii'))

            data = client.recv(1024)
            print ("Nhan duoc tu server:", data)
        except KeyboardInterrupt:
	    GPIO.cleanup()
	finally:
	    print ("Da gui")
        time.sleep(1)
        print_opt = 1
	#on LED
	GPIO.output(02, GPIO.HIGH)
	#on BUZZER
	GPIO.output(04, GPIO.LOW)
        time.sleep(0.2)
	#off BUZZER & LED
        GPIO.output(04, GPIO.HIGH)
        GPIO.output(02, GPIO.LOW)
        time.sleep(0.1)
	if data == '1':
          #LED & BUZZER if true
          #on LED
	  print ("Chao ban den voi buoi hoc!")
          GPIO.output(03, GPIO.HIGH)
          #on BUZZER
          GPIO.output(04, GPIO.LOW)
          time.sleep(0.2)
	  #off BUZZER & LED
          GPIO.output(04, GPIO.HIGH)
          GPIO.output(03, GPIO.LOW)
          time.sleep(0.1)
        elif data == '2':
             #LED & BUZZER if false because more than 2 times
               #first
		#on LED
		print ("Ban da diem danh cho buoi hoc nay!")
                GPIO.output(17, GPIO.HIGH)
                #on BUZZER
                GPIO.output(04, GPIO.LOW)
                time.sleep(0.7)
		#off BUZZER & LED
                GPIO.output(04, GPIO.HIGH)
                GPIO.output(17, GPIO.LOW)
                time.sleep(0.7)
	else:
	      #LED & BUZZER if false because fail
               #first
                #on LED
		print ("Ban khong co tiet hoc nay, vui long kiem tra lai!")
                GPIO.output(27, GPIO.HIGH)
                #on BUZZER
                GPIO.output(04, GPIO.LOW)
                time.sleep(0.3)
                #off BUZZER & LED
                GPIO.output(04, GPIO.HIGH)
                GPIO.output(27, GPIO.LOW)
                time.sleep(0.1)

               #second
                #on  LED
                GPIO.output(27, GPIO.HIGH)
                #on BUZZER
                GPIO.output(04, GPIO.LOW)
                time.sleep(0.3)
                #off BUZZER & LED
                GPIO.output(04, GPIO.HIGH)
                GPIO.output(27, GPIO.LOW)
                time.sleep(0.1)
    if print_opt==1:
        print "\nDua the vao dau doc\n---------------"
    time.sleep(3)



