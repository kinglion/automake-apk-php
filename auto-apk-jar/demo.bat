"C:\Program Files\Java\jdk1.8.0_25\bin\jarsigner" -verbose -keystore key.keystore -storepass yourpass -storetype jks -sigfile CERT -signedjar bbshenqi_signed.apk bbshenqi.apk key.keystore
"D:\android\android-sdk-windows\tools\zipalign" -v 4 bbshenqi_signed.apk d:\apk\bbshenqi00000.apk
del bbshenqi_signed.apk
del bbshenqi.apk
