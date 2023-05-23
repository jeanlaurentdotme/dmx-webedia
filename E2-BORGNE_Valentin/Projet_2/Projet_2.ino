#include <LiquidCrystal.h>
LiquidCrystal lcd = LiquidCrystal(2, 3, 4, 5, 6, 7);
String val;
long nbValues;
long cumulP1;
bool sendValuePot = false;
bool sendText = false;
String sentence2, sentence;
int bp1 = 12;

bool lastPushedState1 = false;

void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  pinMode(bp1, INPUT_PULLUP);
  lcd.begin(16, 2);
  //Serial.setTimeout(5);
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
    val = Serial.readStringUntil('\n');
    if (val[0]=='1')
    {
        sentence = "{\"type\":\"potValues\",\"p1\":";
        sentence += cumulP1 / nbValues;
        sentence += "}";
        Serial.println(sentence);
      //sendValuePot = true;
    }
    else if(val[0] == '2')
    {
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print(val.substring(2));
    }
    /*if (sendValuePot)
    {
        sendValuePot = false;
    }*/
  }
    if (b1 == LOW && !lastPushedState1)
    {
      sentence = "{\"type\":\"button\",\"b1\":1}";
      Serial.println(sentence);
    }
    
    if(b1 == HIGH && lastPushedState1)
    {
      sentence = "{\"type\":\"button\",\"b1\":0}";
      Serial.println(sentence);
    }

    lastPushedState1 = b1 == LOW;
}
