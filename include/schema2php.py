#!/usr/bin/python

import MySQLdb
import sys
import re

DB_HOST="172.21.5.89"
DB_PASS="Iseoptions1"
DB_USER="aocc"
DB_PORT=3306
DB_NAME="aocc"
DB_TABL="testcase"

Y=1
N=0

class TableDefinition:
     """Contains table structure and stores all columns"""
     def __init__(self, tablename):
          self.tablename = tablename
          self.columns = []

     def addColumn(self, column):
          self.columns.append(column)

     def generateIUDPHP(self):
          

class ColumnDefinition:
     """Contains all info about individual columns"""
     def __init__(self, fieldname, datatype, null):
          self.fieldname = fieldname
          self.formname = DB_TABL + "_" + self.fieldname
          self.datatype = datatype
          self.datasize = 0
          self.null = null
          # determine size, if applicable (varchar, int)
          typeCheck=re.match(r'^(?P<typename>\w+)\((?P<size>\d+)\)$', datatype, re.I)
          if typeCheck:
               self.datatype = typeCheck.group('typename')
               self.datasize = typeCheck.group('size')

     def generateInputPHP(self):
          if self.datatype=="varchar":
               print "<label>%s</label><br/>\n<input autocomplete=\"off\" type=\"text\" name=\"%s\" maxlength=\"%s\"/><br/>\n" \
                     % (self.fieldname, self.formname, self.datasize)
          if self.datatype=="int" and not re.match(r'^.*id$', self.fieldname, re.I):
               print "<label>%s</label><br/>\n<input autocomplete=\"off\" type=\"text\" name=\"%s\" maxlength=\"%s\"/><br/>\n" \
                     % (self.fieldname, self.formname, self.datasize)
          if self.datatype=="datetime":
               print "<label>%s</label><br/>\n<input autocomplete=\"off\" type=\"text\" name=\"%s_date\" maxlength=\"10\"/>\n" \
                     "<input autocomplete=\"off\" type=\"text\" name=\"%s_time\" maxlength=\"8\"/><br/>\n" \
                     % (self.fieldname, self.formname, self.formname)

     def generateEnginePHP(self):
          if self.datatype=="varchar":
               print "$%s\t=\tvV($_POST['%s']) ? \"'\".addslashes($_POST['%s']).\"'\" : \"NULL\";" \
                     % (self.formname, self.formname, self.formname)
          if self.datatype=="int" and not re.match(r'^.*id$', self.fieldname, re.I):
               print "$%s\t=\tvV($_POST['%s']) ? $_POST['%s'] : \"NULL\";" \
                     % (self.formname, self.formname, self.formname)
          if self.datatype=="datetime":
               print "$%s\t=\t(vV($_POST['%s_date']) && vV($_POST['%s_time'])) ? \"'\".$_POST['%s_date'].\" \".$_POST['%s_time'].\"'\" : \"NULL\";" \
                     % (self.formname, self.formname, self.formname, self.formname, self.formname)

def dbconnect():
     try:
          db=MySQLdb.connect(host=DB_HOST,port=DB_PORT,user=DB_USER,passwd=DB_PASS,db=DB_NAME)
     except MySQLdb.Error, e:
          errorExit("Can't connect to database. Exiting..." % (e.args[1]));
     return db

def extractData(method):
     tableData=TableDefinition(DB_TABL)
     if method=="dbconn": 
          db=dbconnect()
          cursr=db.cursor()
          sql="SHOW COLUMNS FROM %s;" % DB_TABL
          cursr.execute(sql)
          rawColumnData=cursr.fetchall()
          db.close()
          
          for rcd in rawColumnData:
               tableData.addColumn(ColumnDefinition(rcd[0], rcd[1], rcd[2]))

          for cd in tableData.columns:
               cd.generateInputPHP()

          for cd in tableData.columns:
               cd.generateEnginePHP()
          tableData.generateIUDPHP()
          

def main(argv):
     # create lists for given table (add options later) (2)
     extractData("dbconn")

def errorExit(msg):
     print msg
     sys.exit(1)

if __name__ == "__main__":
     main(sys.argv[1:])
