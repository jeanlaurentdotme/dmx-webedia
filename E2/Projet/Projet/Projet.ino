#include <LiquidCrystal.h>
LiquidCrystal lcd = LiquidCrystal(2, 3, 4, 5, 6, 7);
int potPin = 0;
int incomingByte;


long lastUpdate = 0;
long cumulP1 = 0;
long nbValues = 0;



void setup()
{
  Serial.begin(9600);
  pinMode(22, INPUT_PULLUP);
  lcd.begin(16, 2);
  Serial.setTimeout(10);
}
void loop(){
  /*float mesure1 = analogRead(A0);
  float tension1 = mesure1 *5. / 1023. ;
  float mesure2 = analogRead(A1);
  float tension2 = mesure2 *5. / 1023. ;
  float mesure3 = analogRead(A2);
  float tension3 = mesure3 *5. / 1023. ;
  int b1 = digitalRead(22);
  Serial.print("Potentiomètre 1 :");
  Serial.println(tension1);
  Serial.print("Potentiomètre 2 :");
  Serial.println(tension2);
  Serial.print("Potentiomètre 3 :");
  Serial.println(tension3);
  if (b1 == LOW) {
    Serial.println("Bouton 1 : OK");
  }
  delay(10000);*/

  if(nbValues == 100)
  {
    cumulP1 = 0;
    nbValues = 0;
  }

  cumulP1 += analogRead(A0);
  nbValues++;

  
  
  if (Serial.available() > 0) {
    // read the incoming byte:
    String command = Serial.readString();

    if(command == "potValues")
    {
      String sentence = "{\"type\":\"potValues\",\"p1\":";
      sentence += cumulP1 / nbValues;
      sentence += "}";
      /*sentence += ",\"p2\":";
      sentence += analogRead(A1);
      sentence += ",\"p3\":";
      sentence += analogRead(A2);
      sentence += "}";*/

      Serial.print(sentence);
    }
    else if(command == "check")
    {
      Serial.print("{\"type\":\"check\"}");
    }
    else if(command.substring(0, 6) == "setVal")
    {
      String params = command.substring(7);
      Serial.print(params);
    }
    else
    {
      lcd.setCursor(0, 0);
      lcd.print(command);
      delay(5000);
      lcd.print("                ");
    }
  }
}
