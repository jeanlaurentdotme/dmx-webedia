void setup() {
  Serial.begin(9600);
  pinMode(A1, INPUT);

}

void loop() {
  int val = analogRead(A1);
  Serial.println(val);
  val = val / 4;
  analogWrite(10, val);
  delay(500);

}
