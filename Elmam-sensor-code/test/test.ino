
#include <ESP8266WiFi.h>
#include "DHT.h"
#include "Mic.h" //noise
#include <math.h> // mathmitical oprations 

#define DHTPIN D4
#define DHTTYPE DHT22
#define MIC_3V3_PIN_SIG	A0 // pin mic 
#define BOARD_TYPE "ESP12E"  // Define the board type for ESP-12E
#define BOARD_TYPE "ESP12F"  // Define the board type for ESP-12F

DHT dht(DHTPIN, DHTTYPE);
Mic mic_3v3 (MIC_3V3_PIN_SIG);

const char* ssid     = "HUAWEI-523B";
const char* password = "516DA29HQ64";
const char* host = "192.168.8.193";



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

void setup()
{
  
    Serial.begin(115200);
    Serial.println("DHT22 Output!");
    dht.begin();
  // Initialize GPIO 2 as an input
  pinMode(5, INPUT_PULLUP);
    // Initialize GPIO 4 as an input
  pinMode(4, INPUT_PULLUP);
    // We start by connecting to a WiFi network
  
    Serial.println();
    Serial.println();
    Serial.print("Connecting to ");
    Serial.println(ssid);

    WiFi.begin(ssid, password);

    while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");
    }

    Serial.println("");
    Serial.println("WiFi connected");
    Serial.println("IP address: ");
    Serial.println(WiFi.localIP());
}


const char* detectArduinoType() {
    if (digitalRead(5) == LOW) {
        return "ESP12E";
    } else if (digitalRead(4) == LOW) {
        return "ESP12F";
    } else {
        return "Unknown";
    }
}

void loop()
{
const char* microID = detectArduinoType(); // Detect Arduino type dynamically  
float temperature = dht.readTemperature();
float humidity = dht.readHumidity();  
int mic_3v3Val;
int Gas1 = digitalRead(D0);

mic_3v3Val = mic_3v3.read();
float dB_sound = readingToDecibels(mic_3v3Val); //convert volt to decibels

  if(isnan(temperature) || isnan(humidity) || isnan(mic_3v3Val) || isnan(Gas1)){
    Serial.println("Failed to read ");
  }else{
    Serial.print("Humidity: ");
    Serial.print(humidity);
    Serial.print(" %\t");
    Serial.print("Temperature: ");
    Serial.print(temperature);
    Serial.println(" *C");
    Serial.print("Noise: ");
    Serial.println(dB_sound);
    Serial.print("AirQuality: ");
    Serial.println(Gas1);
    Serial.println(microID);
    delay(3000);
  }
   
    Serial.print("connecting to ");
    Serial.println(host);

    // Use WiFiClient class to create TCP connections
    WiFiClient client;
    const int httpPort = 80;
    if (!client.connect(host, httpPort)) {
        Serial.println("connection failed");
        return;
    }

 



    // This will send the request to the server
 client.print(String("GET http://192.168.8.193/iot_project/connect.php?") + 
                          ("&temperature=") + temperature +
                          ("&humidity=") + humidity +
                          ("&noise=") + dB_sound +
                          ("&airquality=") + Gas1 +
                          ("&microID=") + microID + // Send Arduino type to the server
                          " HTTP/1.1\r\n" +
                 "Host: " + host + "\r\n" +
                 "Connection: close\r\n\r\n");
    unsigned long timeout = millis();
    while (client.available() == 0) {
        if (millis() - timeout > 1000) {
            Serial.println(">>> Client Timeout !");
            client.stop();
            return;
        }
    }

    // Read all the lines of the reply from server and print them to Serial
    while(client.available()) {
        String line = client.readStringUntil('\r');
        Serial.print(line);
        
    }

    Serial.println();
    Serial.println("closing connection");
}

float readingToDecibels(int reading) {    
    float maxValue = 1023;  // Maximum sensor reading
    float dB = -20 * log10(reading / maxValue);
    return dB;
}