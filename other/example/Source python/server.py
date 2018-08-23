#!/usr/bin/env python
# -*- coding: utf-8 -*-
import socket
import MySQLdb
import time

#Khai báo đối tượng socket
#AF_INET là sử dụng IPV4
#AF_INET6 là sử dụng IPV6
#AF_UNIX chỉ các kết nối cùng máy không dùng mạng
#SOCK_TREAM kết nối với TCP
#SOCK_DGRAM kết nối với UDP
server = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
#server = socket.socket(socket.AF_INET6, socket.SOCK_STREAM)

#In thông báo server đang chạy
print ("Starting server on port 2000")

#host là địa chỉ ip của máy server
#host = "192.168.0.100"
#host = "115.76.166.197"
#host = "192.168.43.233"
host = "172.31.34.160"

#Thiết lập host và port cho server
server.bind((host, 2000))

#thiết lập số nối kết cùng lúc vào server, ít nhất là 0, cao nhất là 5
server.listen(5)

# mo ket noi toi Database
db = MySQLdb.connect("127.0.0.1","root","","diem_danh")
# chuan bi mot doi tuong cursor boi su dung phuong thuc cursor()
cursor = db.cursor() 

while True:
	conn, client = server.accept()
	try:
		print ("Connection from", client)
		while True:
			try:
				data = conn.recv(1024)
				index=data.split("_")
				print(data)
				if len(index)==2:
					#print(data)
					#Tìm id_phong học có địa chỉ ip từ client gửi lên
					sql="SELECT ID_PHONG FROM phong WHERE IP_RFID='%s'"%index[1]
					#print(sql)
					cursor.execute(sql)
					data = cursor.fetchone()
					id_phong=data[0]
					#Lấy thông tin ngày giờ hiện tại
					localtime = time.localtime(time.time())
					h=localtime[3]
					mi=localtime[4]
					s=localtime[5]
					d=localtime[2]
					mo=localtime[1]
					y=localtime[0]
					#Tìm xem hiện tại là tiết thứ mấy
					str_time = "%d:%d:%d"%(h,mi,s)
					sql="SELECT ID_TIET FROM tiet_hoc WHERE GIO_BD<='"+str_time+"' AND GIO_KT>='"+str_time+"';"
					cursor.execute(sql)
					data = cursor.fetchone()
					id_tiet_hientai=data[0]
					#Tìm id_nhom_hp và id_lh của tiết hiện tại ở phòng này
					sql="SELECT ID_NHOM_HP,ID_LH FROM lich_hoc WHERE NGAY_HOC='%d-%d-%d' AND ID_PHONG=%d AND ID_TIET<=%d AND ID_TIET+SO_TIET-1>=%d"%(y,mo,d,id_phong,id_tiet_hientai,id_tiet_hientai)
					cursor.execute(sql)
					data = cursor.fetchone()
					if data==None:
						#print("daat0")
						conn.sendall('0')
					else:
						#print("data1")
						id_nhom_hp=data[0]
						id_lh=data[1]
						#Kiem tra xem sinh viên có thuộc nhóm học phần này hay không
						sql="SELECT sv_thuoc_nhom_hp.TAIKHOAN_USER FROM sv_thuoc_nhom_hp JOIN user ON user.TAIKHOAN_USER=sv_thuoc_nhom_hp.TAIKHOAN_USER WHERE MATHE_USER='%s' AND ID_NHOM_HP=%d;"%(index[0],id_nhom_hp)
						
						#print(sql)
						cursor.execute(sql)
						data = cursor.fetchone()
						#Nếu sinh viên không thuộc nhóm học phần này thì gửi về client 0
						#Ngược lại ta tiến hành điểm danh và gửi về client 1
						
						if data==None:
							#print("data10")
							conn.sendall('0')
						else:
							taikhoan=data[0]
							#print("data11")
							sql="SELECT * FROM danh_sach_diem_danh WHERE CHECK_DIEMDANH=0 AND ID_LH=%d AND TAIKHOAN_USER='%s';"%(id_lh,data[0])
							#print(sql)
							cursor.execute(sql)
							data = cursor.fetchone()
							if data==None:
								conn.sendall('2')
							else:
								try:
									sql="UPDATE danh_sach_diem_danh SET CHECK_DIEMDANH=1 WHERE ID_LH=%d AND TAIKHOAN_USER='%s';"%(id_lh,taikhoan)
									#print(sql)
									cursor.execute(sql)
									db.commit()
									conn.sendall('1')
								except Exception:
									conn.sendall('0')
				else:
					conn.sendall('0')
			except Exception:
				break
			else:
				continue
	except Exception:
		conn.close()
		continue
# ngat ket noi voi server
db.close()