#include <LiquidCrystal.h>
LiquidCrystal lcd = LiquidCrystal (2, 3, 4, 5, 6, 7);
void setup() {
  Serial.begin(9600);
  lcd.begin(16, 2);

}

void loop() {
  // put your main code here, to run repeatedly:
  lcd.setCursor(0, 0);
  lcd.print("Bonjour");

}
