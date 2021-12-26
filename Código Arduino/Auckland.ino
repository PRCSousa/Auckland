//..........LCD........................................//
#include <LiquidCrystal_I2C.h>  
#include <Wire.h> 
LiquidCrystal_I2C lcd(0x27,16,2); //definir o LCD 16,2
//...................Pinos....................................//
int pot = A3;           
int botaoConfirmacaoExame = 2;   
int botaoEnvio=3;
int botaoCancelar=4;
int trigPin = 5;         
int echoPin = 6;
int SensorCadeira = 7; 
int LED1=8;
int LED2=9;
int LED3=10;
int LED4=11; 
int LED5=12;   

//.....................Variáveis Inteiras.......................................//
int leitura,i;
int saltar=0;
int exame=1;
unsigned long tempo1,tempo2,tempo3, tempo4, tempo5, Start,StartTUG,tempoTUG1,tempoTUG2,tempoTUG3;
//.......................Variáveis booleanas.........................................//
bool play = false;       
bool comecarExame = false;      
bool levantou=false;
bool envio = false;

//.......................Variáveis flutuantes.......................//      
float duracao, distancia;                      
//...............................................................................//
void setup() 
  {
    lcd.clear();
  //........CONFIGURAÇÕES.....................................................// 
  pinMode(LED1,OUTPUT);
  pinMode(LED2,OUTPUT);
  pinMode(LED3,OUTPUT);
  pinMode(LED4,OUTPUT);
  pinMode(LED5,OUTPUT);
  pinMode(botaoConfirmacaoExame, INPUT_PULLUP); 
  pinMode(botaoEnvio, INPUT_PULLUP);
  pinMode(botaoCancelar, INPUT_PULLUP);
  pinMode(pot,INPUT);           
  pinMode(SensorCadeira,INPUT_PULLUP); 
  pinMode(trigPin,OUTPUT);      // Emissor do ultrassónico -------->OUTPUT
  pinMode(echoPin,INPUT);       //Recetor do ultrassónico ---------->INPUT                                   
  attachInterrupt(digitalPinToInterrupt(botaoConfirmacaoExame), OK, RISING); 
  attachInterrupt(digitalPinToInterrupt(botaoEnvio), Envio, RISING);  
  Serial.begin(9600);           //inicia o serial monitor            
  lcd.init();                   //inicia o lCD
  lcd.backlight();
  }

  //.................Interrupção OK.........................................................................//
  void OK()
    { 
    comecarExame=true; //muda o valor booleano de verdadeiro para falso
    }
 

  //............................Envio de Dados para a base de dados...............................//
  void Envio()
  {
    while(envio==true)
    {
    Serial.println(tempo1);
    delay(10);
    Serial.println(tempo2);
     delay(10);
    Serial.println(tempo3);
     delay(10);
    Serial.println(tempo4);
     delay(10);
    Serial.println(tempo5);
     delay(10);
    Serial.println(tempoTUG1);
     delay(10);
    Serial.println(tempoTUG2);
     delay(10);
    Serial.println(tempoTUG3);
     delay(10);
    envio=false;
  }
}
 
//.......................Seleção do exame a Fazer/MENU...........................................................//
 
  void loop()
  {
   while(!comecarExame) 
      {
        lcd.clear();
        lcd.setCursor(0,1);
        int leituraPot=analogRead(pot);    //Leitura analógica do potenciometro 
        leituraPot=map(leituraPot,0,1023,1,3); //mapeamento dos valores lidos pelo potenciometro de 0---->1023 para 1--->3
         delay(500); 
            switch(leituraPot) //Dependendo do valor da leitura do potenciometro
                {
                    case 1:             
                           lcd.setCursor(0,0);    //definição do local onde será escrito no LCD
                           lcd.print("exame 5xSTS  "); //imprime no LCD o nome do exame
                           exame=1; //exame realizado caso o botão oki seja pressionado
                           delay(2000);
                           break;
                    

                    case 2:   
                           lcd.setCursor(0,0); //definição do local onde será escrito no LCD          
                           lcd.print("exame TUG  "); //imprime no LCD o nome do exame
                           exame=2; //exame realizado caso o botão oki seja pressionado
                           delay(2000);
                           break;
                    case 3:   
                           lcd.setCursor(0,0); //definição do local onde será escrito no LCD          
                           lcd.print("exame TUG  "); //imprime no LCD o nome do exame
                           exame=2; //exame realizado caso o botão oki seja pressionado
                           delay(2000);
                           break;
         
                    default:
                            break;              
  
               }

       }
          
      while (comecarExame)
            {
              switch(exame) //Em função do valor apresentado no potenciômetro teremos os seguintes casos:
                           {
                              case 1: lcd.setCursor(0,0);    //definição do local onde será escrito no LCD
                                      lcd.print("exame 5xSTS"); //imprime no LCD o nome do exame
                                      lcd.setCursor(0,1);     
                                      lcd.print("Selecionado");  
                                      FivexSTS();        //Realiza a função/exame 5xSTS
                                      comecarExame=false; // regressará ao menú inicial no final do exame
                                      envio=true;
                                      break;

                              case 2: lcd.setCursor(0,0); //definição do local onde será escrito no LCD          
                                      lcd.print("exame TUG   "); //imprime no LCD o nome do exame
                                      lcd.setCursor(0,1); 
                                      lcd.print("Selecionado"); //Se o valor for 2 é realizada a função TUG
                                      TUG();     //Realiza a função/exame TUG
                                      comecarExame=false;    // regressará ao menú inicial no final do exame
                                      envio=true;
                                      break;
                                      
                             default:
                                      break;
                         }
                }           
  }


//................................TUG......................................//
 
void ultra()   //função que permite calcular a distancia do paciente ao sensor:
{
  
  digitalWrite(trigPin,LOW);     
  delayMicroseconds(2);
  digitalWrite(trigPin, HIGH);  //Envia um sinal através do triggerPin--->gatilho
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  duracao = pulseIn(echoPin, HIGH); //calcula o tempo que o EchoPin demora a receber o sinal que foi emitido
  distancia= duracao*0.034/2; //calcula a distancia que o objeto está do sensor
}

void TUG()
    {//..............Debouncing e leitura do SensorCadeira......//
      i = 0;
      play=false;
      digitalWrite(LED1,HIGH);
      digitalWrite(LED2,HIGH);
      digitalWrite(LED3,HIGH);
      digitalWrite(LED4,HIGH);
      digitalWrite(LED5,HIGH);
  while(play==false)
      { 
        leitura = digitalRead(SensorCadeira);       
        
         if (leitura==0)
         {
          

          while (digitalRead(SensorCadeira)==0)
              {
                if(digitalRead(botaoCancelar)==0)
                     {
                      break;
                      
                      }
               }
           
            {
          lcd.clear();
          play=true;  
          StartTUG=millis();
      digitalWrite(LED1,LOW);
      digitalWrite(LED2,LOW);
      digitalWrite(LED3,LOW);
      digitalWrite(LED4,LOW);
      digitalWrite(LED5,LOW);
           }
         }
         

    }
    //..............Paciente levantou-se e espera-se passar no HC-SR04 2 Vezes......//

 while(play==true)
 {
  ultra();
  //.......................Cancelar Exame e anular tempos..............//
  if(digitalRead(botaoCancelar)==0)
  {
    lcd.clear();
    lcd.print("A reiniciar...");                    
    tempoTUG1=0;
    tempoTUG2=0;
    tempoTUG3=0;
    delay(1000);
    break;
    }
    
    //...................................................................//
  if((distancia>5)&&(distancia<70))
  {
    i++;
     switch(i)
     { 
      case 1:
            
            tempoTUG1= (millis()-StartTUG);
            lcd.clear();
            lcd.print(" 1 passagem");
           delay(1000);//para evitar mais que uma leitura
           break;
           

      case 2: 
              tempoTUG2= (millis()-StartTUG);
              lcd.clear();
              lcd.print(" 2 passagem");
             delay(700);
             play=!play;
             break;
      default:
             break;       
     }
   }  
 } //..............Após passar no sensor, espera-se que se sente......//
     while(play==false)
     {
      //.................................Cancelar Exame e anular tempos............//
       if(digitalRead(botaoCancelar)==0||saltar==1)
  {
     lcd.clear();
     lcd.print("A reiniciar...");
     delay(1000);                 
    tempoTUG1=0;
    tempoTUG2=0;
    tempoTUG3=0;
    
    break;
    }
    //.................................................................................//
        if(digitalRead(SensorCadeira)==0)
          {
            play=true;
            tempoTUG3= (millis()-StartTUG);
            digitalWrite(LED1,HIGH);
            digitalWrite(LED2,HIGH);
            digitalWrite(LED3,HIGH);
            digitalWrite(LED4,HIGH);
           digitalWrite(LED5,HIGH);
           delay(2000);
          }
     }
     digitalWrite(LED1,LOW);
     delay(500);
     digitalWrite(LED2,LOW);
     delay(500);
     digitalWrite(LED3,LOW);
     delay(500);
     digitalWrite(LED4,LOW);
     delay(500);
     digitalWrite(LED5,LOW);
 }
 


//.........................................................5xSTS................................................//
void FivexSTS() 
{     //..............Debouncing e leitura do SensorCadeira......//
    i=0;
    play = false;
    digitalWrite(LED1,HIGH);
    digitalWrite(LED2,HIGH);
    digitalWrite(LED3,HIGH);
    digitalWrite(LED4,HIGH);
    digitalWrite(LED5,HIGH);
   while(play==false)
      { 
        leitura = digitalRead(SensorCadeira);       
         if (leitura==0)
         {
          while (digitalRead(SensorCadeira)==0)
          {
            if(digitalRead(botaoCancelar)==0)
                     {
                        lcd.clear();
                        lcd.print("A reiniciar...");
                        delay(1000);   
                        break;
                      }
            
          }
           play=true;  
           Start=millis() ;
           digitalWrite(LED1,LOW);
            digitalWrite(LED2,LOW);
            digitalWrite(LED3,LOW);
            digitalWrite(LED4,LOW);
           digitalWrite(LED5,LOW);
             
         }  


         
         //................Paciente levanta-se e senta-se-a 5 vezes.......................//
               
      }     
    while(play==1) //Enquanto a condição play for verdadeira:
       { 
         while((levantou)==false)
         {
          //........................Cancelar e Descartar os tempos........................//
          if(digitalRead(botaoCancelar)==0)
          {
            lcd.clear();
            lcd.print("A reiniciar...");
            tempo1=0;
            tempo2=0;
            tempo3=0;
            tempo4=0;
            tempo5=0;
            delay(1000);             
            break;
           //.............................................................................//
            }
          if(digitalRead(SensorCadeira)==1)
            {
             levantou=true;
             delay(20);
            }
          
          }
          //........................Cancelar e Descartar os tempos........................//
           if(digitalRead(botaoCancelar)==0)
              {
               lcd.clear();
               lcd.print("A reiniciar...");
               tempo1=0;
               tempo2=0;
               tempo3=0;
               tempo4=0;
               tempo5=0;
               delay(1000); 
                break;
              }
    //........................................................................................//     
         if (digitalRead(SensorCadeira)== 0) // Se o sensor da cadeira for pressioanado:
            { 
              delay(20);                     
               i++;
                 switch(i)
                        {  
                          case 1:
                                  tempo1=(millis()-Start);  
                                  lcd.clear();
                                  lcd.print(" sentado: 1");
                                  delay(20);
                                  levantou=false;
                                  digitalWrite(LED1,HIGH);
                                  break;  

                          case 2:
                                   tempo2=(millis()-Start);
                                   lcd.clear();
                                   lcd.print(" sentado: 2");
                                   delay(20);
                                   levantou=false;
                                   digitalWrite(LED2,HIGH);
                                   break;  

                          case 3:
                                   tempo3=(millis()-Start);
                                   lcd.clear();
                                   lcd.print(" sentado: 3");
                                   delay(20);
                                   levantou=false;
                                   digitalWrite(LED3,HIGH);
                                   break;  

                          case 4: 
                                   tempo4=(millis()-Start);
                                   lcd.clear();
                                   lcd.print(" sentado: 4");
                                   delay(20);
                                   levantou=false;
                                   digitalWrite(LED4,HIGH);
                                   break;  

                          case 5: 
                                   tempo5=(millis()-Start);
                                   lcd.clear();
                                   lcd.print(" sentado: 5");
                                   delay(20);
                                   play=false;
                                   digitalWrite(LED5,HIGH);
                                   delay(1000);
                                   break;  

                          default:
                                    break;

                        }
                        
                   }
              }
           digitalWrite(LED1,LOW);
           delay(500);
           digitalWrite(LED2,LOW);
           delay(500);
           digitalWrite(LED3,LOW);
           delay(500);
           digitalWrite(LED4,LOW);
           delay(500);
           digitalWrite(LED5,LOW);
            
       }
                        
      
            
  
