#include "SoftwareSerial_Class.h"
SoftwareSerial RFID(8, 3); // RX and TX
int RFi;
/////////////////////////////////////////////// Keypad Library and Connection ///////////////////////////////////////////////
#include <Keypad.h>
const byte ROWS = 4; //four rows
const byte COLS = 4; //four columns
//define the cymbols on the buttons of the keypads
char hexaKeys[ROWS][COLS] = {
  {'D','#','0','*'},
  {'C','9','8','7'},
  {'B','6','5','4'},
  {'A','3','2','1'}
};
byte rowPins[ROWS] = {3,4,5,6}; //connect to the row pinouts of the keypad
byte colPins[COLS] = {8,9,10,11}; //connect to the column pinouts of the keypad

/////////////////////////////////////////////// WIFI connections ///////////////////////////////////////////////
//initialize an instance of class NewKeypad
Keypad customKeypad = Keypad( makeKeymap(hexaKeys), rowPins, colPins, ROWS, COLS); 
#define IP "iot4cie.esy.es" // thingspeak.com
#define SSSID "Mohamed alaa"
#define PASS "Karim011mAl"
void setup() {
  Serial1.begin(115200); // for arduino mega
  Serial.begin(9600); //for serial port
  //delay(4000);

  while(Serial1.available()>0)
    //Serial.read();
    delay(1000);

  //Serial.println("AT"); //Testing module
  Serial1.println("AT");
  if(Serial1.find("OK"))
  {
    //Serial.println("Module is ready");
  }
  else
  {
    //Serial.println("Module have no response.");
  }
  Serial1.println("AT+CWMODE=1"); // SETTING mode
  //Serial.println("AT+CWMODE=1");
  delay(200);
  if(Serial1.find("OK"))
  {
    //Serial.println("Mode set");
  }
  else
  {
    //Serial.println("Module have no response.");
  }
  while(Serial1.find("OK") == false)
  {
    String wifi="AT+CWJAP=\"";
    wifi+=SSSID;
    wifi+="\",\"";
    wifi+=PASS;
    wifi+="\"";
    //Serial.println(wifi);
    Serial1.println(wifi);
    delay(5000);
  }
  //Serial.println("Connected");
  Serial1.println("AT+CIPMUX=1"); // changing mode
  //Serial.println("AT+CIPMUX=1");
  delay(200);
  if(Serial1.find("OK"))
  {
    //Serial.println("Mode set");
  }
  else
  {
    //Serial.println("Module have no response.");
  }
  //Serial.print("Connecting to ");
  //Serial.println(IP);

  while(Serial1.find("OK") == false)
  {
    String page = "AT+CIPSTART=4,\"TCP\",\"";
    page += IP;
    page += "\",80";
    Serial1.println(page);
    //Serial.println(page);
    delay(5000);
  }
  Serial.println("Linked");
  RFID.begin(9600); // start serial to RFID reader
}
String wificonn (String fileName){
  //int x=analogRead(A0);
  String cmd = "GET ";
  //out = callAT(5, "InsertProcess.php?CustomerID="+cID+"&SellerID="+cnID+"&SellerProfit="+sProfit+"&NetCustomer="+cProcess);
  //orderStr = atCommands[5] + orderStr + " HTTP/1.1\r\nHost: " + hostName + "\r\nConnection: close\r\n\r\n";
  String url = "/"+fileName+" HTTP/1.1\r\nHost: iot4cie.esy.es\r\nConnection: close\r\n\r\n"; //thingspeak channel taking readings
  cmd += url;
  //cmd += x;
  //cmd += " HTTP/1.0\r\n\r\n";
  //Serial.print("AT+CIPSEND=4,");//determine how many bytes
  //Serial.println(cmd.length());
  Serial1.print("AT+CIPSEND=4,");
  Serial1.println(cmd.length());
  
  if(Serial1.find("OK")){
    //Serial.println("OK");
  }else{
    //Serial.println("ERROR");
  }
  
  Serial1.print(cmd);//send request
  //delay(250);
  String ans="";
  while (Serial1.available()){
    char c = Serial1.read();
    ans=ans+c;
    //Serial.write(c);
    //if(c=='\r') Serial.print('\n');
  }
  
  //Serial.print("\n");
  //Serial.println("\r\n.............................");
  delay(5000);
  while(Serial1.find("OK") == false){
    String page = "AT+CIPSTART=4,\"TCP\",\"";
    page += IP;
    page += "\",80";
    Serial1.println(page);
    //Serial.println(page);
    delay(7000);
  }
  return ans;
  //Serial.println("Linked");
}
char keypadFun(){
  char customKey = customKeypad.getKey();
  if (customKey){
    return customKey;
    //Serial.println(customKey);
  }
}
String IDarr;
void RFIDFun(){
  for (int i=0;i<14;i++){
    if (RFID.available() > 0)
    {
    RFi = RFID.read();
    IDarr=IDarr+RFi;
   }
  }
}

void loop() {
  //wificonn ();
  //RFID scan ---> RFIDFun() /InsertProcess.php?PersonID=1
  String passDB="";
  while(passDB==""){
    RFIDFun();
    passDB=wificonn ("/selectID.php?RFID="+IDarr);
    
  }
  
  
  //print LCD (enter passward) ---> LCDFun()
  
  //keypad take passward ---> keypadFun()
  String passInput="";
  while (passInput!=passDB){
    char in='Q';
    while (1){
      in=keypadFun();
      if (in=='A' || in=='B') break;
      passInput=passInput+in;
    }
    if (in=='B') continue;
  }
  //list all options (balacne - buy ) ---> LCDFun()
  
  //if balance
    // LCD print() ---> LCDFun()
  //if buy
    // LCD scrolar list ---> shabanFun()
    // retrieve balance from database ---> wificonn ()
    // update balance ---> wificonn ()
}








