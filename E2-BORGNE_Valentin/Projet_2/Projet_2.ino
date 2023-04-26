#include <LiquidCrystal.h>
LiquidCrystal lcd = LiquidCrystal(2, 3, 4, 5, 6, 7);
String val;
long nbValues;
long cumulP1;
void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  pinMode(22, INPUT_PULLUP);
  lcd.begin(16, 2);
}

void loop() {
  if (nbValues == 100)
  {
   cumulP1 = 0;
   nbValues = 0;
  }
  cumulP1 += analogRead(A0);
  nbValues++;
  if (Serial.available() > 0)
  {
    lcd.clear();
    val = Serial.readString();
    if (val=="1")
    {
        String sentence = "{\"p1\":";
        sentence += cumulP1 / nbValues;
        sentence += "}";
        Serial.println(sentence);
    }
    lcd.setCursor(0, 0);
    lcd.print(val);
  }
}
