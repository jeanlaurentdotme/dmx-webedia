#include <LiquidCrystal.h>
LiquidCrystal lcd = LiquidCrystal(2, 3, 4, 5, 6, 7);
String val;
long nbValues;
long cumulP1;
bool sendValuePot = false;
bool sendText = false;
String sentence2, sentence;
int bp1 = 12;
void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  pinMode(bp1, INPUT_PULLUP);
  lcd.begin(16, 2);
  Serial.setTimeout(10);
}

void loop() {
  int b1 = digitalRead(bp1);
  if (nbValues == 100)
  {
   cumulP1 = 0;
   nbValues = 0;
  }
  cumulP1 += analogRead(A0)/4;
  nbValues++;
  if (Serial.available() > 0)
  {
    val = Serial.readString();
    if (val=="1")
    {
        sentence = "{\"p1\":";
        sentence += cumulP1 / nbValues;
        sentence += "}";
        Serial.println(sentence);
      //sendValuePot = true;
    }
    else
    {
      lcd.clear();
      lcd.setCursor(0, 0);
      //lcd.print(val);
      lcd.print("tu joue a cs");
      lcd.setCursor(0,1);
      lcd.print("apres genshin");
    }
    /*if (sendValuePot)
    {
        sendValuePot = false;
    }*/
  }
    if (b1 == LOW)
    {
      Serial.println("button pressed");
      delay(100);
    }
}
