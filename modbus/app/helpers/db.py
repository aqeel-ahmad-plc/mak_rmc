import mysql.connector

config = {
  "host" :"localhost",
  "user" :"root",
  "password" :"mak123456",
  "database" :"mak"
}

class DB():
    def __init__(self, config):
        self.connection = None
        self.connection = mysql.connector.connect(**config)

    def query(self, sql, args):
        cursor = self.connection.cursor()
        cursor.execute(sql, args)
        return cursor

    def insert(self,sql,args):
        cursor = self.query(sql, args)
        id = cursor.lastrowid
        self.connection.commit()
        cursor.close()
        return id

mydb = DB(config)
print(mydb)
# mycursor = mydb.cursor()
#
# mycursor.execute("SHOW COLUMNS FROM stats")
#
# for x in mycursor:
#   print(x)
