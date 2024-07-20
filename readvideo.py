import cv2

plat_detector = cv2.CascadeClassifier(cv2.data.haarcascades + "haarcascade_russian_plate_number.xml")
video = cv2.VideoCapture('Data/Cars.mp4')

if not video.isOpened():
    print('Error Reading Video')

while True:
    ret, frame = video.read()    
    if not ret:
        break
    
    gray_video = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    plates = plat_detector.detectMultiScale(gray_video, scaleFactor=1.2, minNeighbors=5, minSize=(25,25))

    for (x, y, w, h) in plates:
        cv2.rectangle(frame, (x, y), (x+w, y+h), (255, 0, 0), 2)
        # Remove the blur effect line below
        # frame[y:y+h, x:x+w] = cv2.blur(frame[y:y+h, x:x+w], ksize=(8, 8))
        cv2.putText(frame, 'License Plate', org=(x-3, y-3), fontFace=cv2.FONT_HERSHEY_COMPLEX, 
                    color=(0, 0, 255), thickness=1, fontScale=0.6)
        
    cv2.imshow('Video', frame)

    if cv2.waitKey(25) & 0xFF == ord("q"):
        break

video.release()
cv2.destroyAllWindows()
