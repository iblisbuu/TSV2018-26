#!/usr/bin/env python
# -*- coding: utf-8 -*-


import signal
from module.MFRC522 import MFRC522
from module.pinos import PinoControle

##from MFRC522 import MFRC522
##from pinos import PinoControle

__author__ = "Erivando Sena Ramos (Adaptations)"
__copyright__ = "Mario Gómez"
__email__ = "erivandoramos@bol.com.br"
__status__ = "Prototype"

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
            while True:
                (status, TagType) = self.MIFAREReader.MFRC522_Request(self.MIFAREReader.PICC_REQIDL)
                (status, uid) = self.MIFAREReader.MFRC522_Anticoll()
                
                if status == self.MIFAREReader.MI_OK:
                    print "Ganesh 1"
                    return self.obtem_tag(self.MIFAREReader, status, uid, autenticacao)
                
                else:
                    self.pc.atualiza(self.RST1, self.pc.baixo())
##                    return 0

                self.MIFAREReader = MFRC522(self.RST2, self.SPI_DEV1)

                #while True:
                (status, TagType) = self.MIFAREReader.MFRC522_Request(self.MIFAREReader.PICC_REQIDL)
                (status, uid) = self.MIFAREReader.MFRC522_Anticoll()
                    
                if status == self.MIFAREReader.MI_OK:
                    print "Ganesh 2"
                    return self.obtem_tag(self.MIFAREReader, status, uid, autenticacao)
                else:
                    self.pc.atualiza(self.RST2, self.pc.baixo())
##                    return 0


        except Exception as e:
            print e
        finally:
            self.MIFAREReader.fecha_spi()
			
    def obtem_tag(self, MIFAREReader, status, uid, autenticacao):
        try:
			if autenticacao:
				# Khoa xac thuc
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
			
