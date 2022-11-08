#include <ESP8266WiFi.h>
#include <WiFiClient.h> 
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
#include "DHT.h"

#define DHTTYPE DHT11

int Led_OnBoard = 2;
const int DHTPin= 5;

const char* ssid = "soumalya";
const char* password = "12344321";

DHT dht(DHTPin, DHTTYPE);

void setup() {
  delay(1000);
  pinMode(Led_OnBoard, OUTPUT);
  Serial.begin(115200);
  WiFi.mode(WIFI_OFF);
  delay(1000);
  WiFi.mode(WIFI_STA);
  
  WiFi.begin(ssid, password);
  Serial.println("");

  Serial.print("Connecting");

  while (WiFi.status()!= WL_CONNECTED) {
    digitalWrite(Led_OnBoard, LOW);
    delay(250);
    Serial.print(".");
    digitalWrite(Led_OnBoard, HIGH);
    delay(250);
  }

  digitalWrite(Led_OnBoard, HIGH);

  Serial.println("");
  Serial.println("Connected to Network/SSID");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
}

void loop()
{
  float t, h;
  t= dht.readTemperature();
  h= dht.readHumidity();

  if(!isnan(t) || !isnan(h))
  {
    HTTPClient http;
    String temp, humid, postData, deviceID;
    temp= String(t);
    humid= String(h);
    deviceID= "WB0002";

    postData ="deviceID="+deviceID+"&temp="+temp+"&humid="+humid;

    http.begin("http://192.168.0.198/farm/partials/_sensorstoredata.php");
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    int httpCode = http.POST(postData);
    String payload = http.getString();

    if(payload== "1" && httpCode== 200){
      digitalWrite(Led_OnBoard, LOW);
      delay(500);
      digitalWrite(Led_OnBoard, HIGH);
    }
    Serial.println(payload);
    Serial.println("Temperature= " + temp);
    Serial.println("Humidity= " + humid);

    http.end();
  }
  delay(5000);
}
