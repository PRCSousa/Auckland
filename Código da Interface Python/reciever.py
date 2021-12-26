#!/usr/bin/python

import mysql.connector
import serial 
import time

cnx = mysql.connector.connect(user='123456789', password='auckland',
                              host='localhost',
                              database='pap')
cursor = cnx.cursor(prepared=True)

device = '/dev/ttyACM0'
try:
  print "A tentar...",device 
  arduino = serial.Serial(device, 9600) 
except: 
  print "Erro a conectar ao",device    

while 1:
  print "A espera de dados"
  sts_1 = arduino.readline()
  print "A recolher dados"
  time.sleep(1)
  sts_2 = arduino.readline()
  time.sleep(1)
  sts_3 = arduino.readline()
  time.sleep(1)
  sts_4 = arduino.readline()
  time.sleep(1)
  sts_5 = arduino.readline()
  time.sleep(1)
  tug_1 = arduino.readline()
  time.sleep(1)
  tug_2 = arduino.readline()
  time.sleep(1)
  tug_3 = arduino.readline()
  time.sleep(1)
  print "Dados recolhidos:",sts_1,sts_2,sts_3,sts_4,sts_5,tug_1,tug_2,tug_3
  sts1 = int(sts_1)
  sts2 = int(sts_2)
  sts3 = int(sts_3)
  sts4 = int(sts_4)
  sts5 = int(sts_5)
  tug1 = int(tug_1)
  tug2 = int(tug_2)
  tug3 = int(tug_3)
  print "A inserir na base de dados"
  print " "
  time.sleep(1)
  sql = """INSERT INTO resultados (Nome,Idade,Sexo,NIF,Localidade,Morada,Contacto,tempo_1_sts,tempo_2_sts,tempo_3_sts,tempo_4_sts,tempo_5_sts,tempo_1_tug,tempo_2_tug,tempo_3_tug)
         VALUES ('Teste Mais Recente',99,'M',123456789,'Localidade','Morada',910000000,%s,%s,%s,%s,%s,%s,%s,%s)"""
  cursor.execute(sql, (sts1, sts2, sts3, sts4, sts5, tug1, tug2, tug3))
  cnx.commit()
  print "Inserido com sucesso"

