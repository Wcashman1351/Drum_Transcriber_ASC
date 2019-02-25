# Drum Transcriber

Drum Transcriber is an open source (with a [public repository](https://github.com/Wcashman1351/Drum_Transcriber_ASC) on git hub), internet-enabled musical development system which assists the user in transcribing and publishing personal drum compositions without any expensive or invasive equipment. 

Detailed implementation can be accessed from [Zoey Chen](https://cs.anu.edu.au/courses/china-study-tour/news/#zoey-chen) and [William Cashman](https://cs.anu.edu.au/courses/china-study-tour/news/#william-cashman)'s blog posts.

# New Features!

  - Drum hits detection 
  - Drum notes graphical presentation
  - Interactive UI
  - Fast WiFi transmission


### Installation
#### Physical requirements
Drum Transcriber requires an ESP32-PICO-KIT, a minisense 100 vibration sensor (horizontal) and jumper wires. Things might help: breadboard.

Attach the sensor onto the counter hoop of the drum, connect the sensor and ESP32-PICO-KIT using jumper wires.

#### Software requirements
##### For Micro-controller (ESP32-PICO-KIT)
Download and install Arduino IDE from [Arduino.cc](https://www.arduino.cc/en/main/software).
Upload the code to ESP32 using Arduino IDE.


##### For Web Server 
Download and install PHP and MySQL (?)

### Development

Drum Transcriber is open to push requests! 

Contact us at u6374918@anu.edu.au (Will) or zhuo.chen1@anu.edu.au (Zoey).

### Todos

- (UI) Enable newsfeed, more interactive, more aesthetic.
- (Raw data and analyse) Use microphone to read in sound wave and do fourior transform on it to determine if hit or not.
- (Network/Wireless transmission) Use TCP to transmit the data directly between the micro-controller and the server instead of transmit via HTTP calls.
- (Drum Technique Detection) Rolling can be detected by setting a limit and when the hits per unit time is faster than the limit, then all the hits would be recorded as a roll.
- (Noise Cancellation, sensor) Apply an active low-pass filter design on the vibration sensor using operational amplifiers.
- (Noise Cancellation, math) Decrease the strength of 4PHD, or, make the noise filter more general.
- ......


License
----

ANU


**Have Fun With Creating New Music!!**

[//]: # (References)


   [William Cashman Blog Post]: <https://cs.anu.edu.au/courses/china-study-tour/news/#william-cashman>
   [Zoey Chen Blog Post]: <https://cs.anu.edu.au/courses/china-study-tour/news/#zoey-chen>
   

