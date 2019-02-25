#include <iostream>
using namespace std;
#include <ArduinoHttpClient.h>
#include <WiFi.h>
#include <HTTPClient.h>
#include <deque>

// Sensor
const int sensorPin = 34;    // select the input pin for the potentiometer
int sensorValue = 0;  // variable to store the value coming from the sensor
unsigned long byteCount = 0;

// WiFi information
const char* serverAddress = "9f54da73.ngrok.io";
const char* ssid = "Example WiFi Name";
const char* password =  "WiFi Password";
int port = 80;
WiFiClient wifi;
HttpClient client = HttpClient(wifi, serverAddress, port);
int status = WL_IDLE_STATUS;

// Music note length calculation
// Each 1/8 note is treated as a unit value
static const int windowSize = 100;
String bars = "addscore=_";
int len = 0;
unsigned long startTimer = 0;
unsigned long endTimer = 0;
unsigned long startBars = 0;
unsigned long endBars = 0;
int total = 0;

// Capturing Hits
std::deque<int> dataQ_(windowSize);
int sum_ = 0;
bool preHit_ = false;
bool startHit_ = false;
bool endHit_ = true;
int count_ = 0;
int countEnd_ = 0;


void setup() {
  Serial.begin(115200);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi WiFi User Name");
  }
  Serial.println("Connected to the WiFi network");
}

void loop() {
  // read the value from the sensor:
  sensorValue = analogRead(sensorPin);
  
  // Store the value returned by sensor 
  // Use the past 100 data values to calculate 
  // integral and derivatives
  dataQ_.push_back(sensorValue);
  sum_ += sensorValue;
  const int front = dataQ_.front();
  sum_ -= front;
  dataQ_.pop_front();
  const float integral = sum_ / windowSize;
  const int derivative = dataQ_.back() - front;
  const float loga = log(sensorValue);
 
// Three points hit detection 
  // PreHit point
  if ((integral == 0) && (derivative == 0) && (preHit_ == false) && (startHit_ == false) && (endHit_ == true)) {
    if (countEnd_ == 50) {
      ++count_;
      std::cout << "Pre" << " count " << count_ << std::endl;
      endHit_ = false;
      preHit_ = true;
    } else {
      countEnd_ += 1;
    }
  }

  //Hit point
  if ((integral < derivative ) && (integral > 200) && (preHit_ == true) && (startHit_ == false) && (endHit_ == false)) {
    std::cout << "Hit" << std::endl;
    preHit_ = false;
    startHit_ = true;
    delay(50);
  }

  /*
              // Remove noise if it is actually a noise
              // Needs to be improved to remove only noise
              // (Currently too strong and removes not only the noise
              // but also the hits)
              if ((integral > derivative * 2 ) && (derivative < 1000) && (preHit_ == false) && (startHit_ == true) && (endHit_ == false)) {
                  --count_;
                  std::cout << "NOISE!!" << step_ << " count back to " << count_ << std::endl;
                  startHit_ = false;
                  endHit_ = true;
              }
  */

  // EndHit point
  // Note length calculation
  if ((integral > derivative ) && (derivative < 50) && (preHit_ == false) && (startHit_ == true) && (endHit_ == false)) {
    if (countEnd_ == 50) {
      std::cout << "End" << std::endl;
      Serial.println("Current bar " + bars);
      startHit_ = false;
      endHit_ = true;
      countEnd_ = 0;
      if (startTimer != 0) {
        endTimer = millis();
        // Calculate how many 1/8 notes does this note worth
        len = (endTimer - startTimer) / 125;
        // Every 4 bars
        // Send the bars to the server
        if (total + len > 128) {
          bars += String(128 - total);
          Serial.println("Sending 4 bars");
          sendHTTP(bars);
          Serial.println("Sent 4 bars");
          bars = "addscore=";
          total = 0;
          startTimer = endTimer;
        } else {
          bars += String(len);
          bars += '_';
          total += len;
          startTimer = endTimer;
        }
      } else {
        startTimer = millis();
      }    
      std::cout << "Total len " << total << std::endl;
      std::cout << "Current len " << len << std::endl;
      } else {
      countEnd_ += 1;
    }
  }

  /*
               // Old hit detection Technique 
               // (Two points hit detection)
              if ((integral == 0) && (derivative == 0) && (endHit_ == true) && (startHit_ == false)) {
                  ++count_;
                  std::cout << "HIT at step " << step_ << " count " << count_ << std::endl;
                  startHit_ = true;
                  endHit_ = false;
              }

              if ((integral < derivative ) && (startHit_ == true) && (endHit_ == false)) {
                  std::cout << "End HIT at step" << step_ << " count " << count_ << std::endl;
                  startHit_ = false;
                  endHit_ = true;
              }
  */
}


// Send given musicScore to the server
void sendHTTP(String musicScore) {
  String path = "/submit.php";
  String contentType = "text/plain";
  client.get("http://9f54da73.ngrok.io/submit.php?"+musicScore);
}
