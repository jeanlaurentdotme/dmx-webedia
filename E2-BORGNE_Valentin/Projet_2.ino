#include <LiquidCrystal.h>
LiquidCrystal lcd = LiquidCrystal(2, 3, 4, 5, 6, 7);
String val;
long nbValues;
long cumulP1;
bool sendValuePot = false;
bool sendText = false;
String sentence2, sentence;
int bp1 = 8;
int bp2 = 12;
int bp3 = 13;

bool lastPushedState1 = false;
bool lastPushedState2 = false;
bool lastPushedState3 = false;

void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  pinMode(bp1, INPUT_PULLUP);
  pinMode(bp2, INPUT_PULLUP);
  pinMode(bp3,INPUT_PULLUP);
  lcd.begin(16, 2);
  Serial.setTimeout(500);
}

void loop() {
  int b1 = digitalRead(bp1);
  int b2 = digitalRead(bp2);
  int bsave = digitalRead(bp3);
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

      sentence = "{\"type\":\"ackScene\", \"value\":\"";
      sentence += val;
      sentence += "\"}";
        Serial.println(sentence);
    }
    else
    {
      sentence = "{\"type\":\"default\", \"value\":\"";
      sentence += val;
      sentence += "\"}";
        Serial.println(sentence);
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
    
    if (b1 == HIGH && lastPushedState1)
    {
      sentence = "{\"type\":\"button\",\"b1\":0}";
      Serial.println(sentence);
    }

    if (b2 == LOW && !lastPushedState2)
    {
      sentence = "{\"type\":\"button\",\"b2\":1}";
      Serial.println(sentence);
    }
    
    if (b2 == HIGH && lastPushedState2)
    {
      sentence = "{\"type\":\"button\",\"b2\":0}";
      Serial.println(sentence);
    }

    if (bsave == LOW && !lastPushedState3)
    {
      sentence = "{\"type\":\"button\",\"b3\":1}";
      Serial.println(sentence);
    }
    
    if (bsave == HIGH && lastPushedState3)
    {
      sentence = "{\"type\":\"button\",\"b3\":0}";
      Serial.println(sentence);
    }

    lastPushedState1 = b1 == LOW;
    lastPushedState2 = b2 == LOW;
    lastPushedState3 = bsave == LOW;
}
