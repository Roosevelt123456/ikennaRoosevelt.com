from cv2 import detail_Blender

import HandTrackingmodule as htm
import cv2
import time
import autopy
import numpy as np
import pyautogui



wCam, hCam = 640, 480
cap = cv2.VideoCapture(0)
cap.set(3, wCam)
cap.set(4, hCam)
frameR = 100 #Frame Reduction
smoothening = 7
plocX, plocY = 0, 0
clocX, clocY = 0, 0

detector=htm.handDetector(maxHands=1)
wscr, hscr = autopy.screen.size()
# print(wscr, hscr)
while True:
    success, img = cap.read()
    img = detector.findHands(img)
    lmList, bbox = detector.findPosition(img)

    # 2.Get the tip of the index and middle fingers
    if len(lmList) != 0:
        x1, y1 = lmList[8][1:]
        x2, y2 = lmList[12][1:]
        z1, z2 = lmList[4][1:]

        #print(x1, y1, x2, y2)

        # 3. check which fingers are up
        fingers = detector.fingersUp()
      #  print(fingers)
        cv2.rectangle(img, (frameR, frameR), (wCam - frameR, hCam - frameR), (255, 0, 255), 2)

        #4. only index finger : moving mode
        if fingers[1] == 1 and fingers[2] == 0:

            # 5. convert coordinates
            x3 = np.interp(x1, (frameR, wCam-frameR), (0, wscr))
            y3 = np.interp(y1, (frameR, hCam-frameR), (0, hscr))




            # 6 smoothen values
            clocX = plocX + (x3 - plocX) / smoothening
            clocY = plocY + (y3 - plocY) / smoothening







            # 7. move mouse
            autopy.mouse.move(wscr-clocX, clocY)
            # setting pointer color
            cv2.circle(img, (x1, y1), 15, (255, 0, 255), cv2.FILLED)
            plocX, plocY = clocX, clocY

        # 8. both index and middle fingers are up : clicking mode            clocY = plocY + (y3 - plocY) / smoothening
        if fingers[1] == 1 and fingers[2] == 1:
            # 9. Find distance between fingers
            lengh, img, lineInfo = detector.findDistance(8, 12, img)
            print(lengh)
            # 10. click mouse if distance short
            if lengh < 40:
                cv2.circle(img, (lineInfo[4], lineInfo[5]), 15, (8, 255, 0), cv2.FILLED)
                autopy.mouse.click()



        #11 click and drag mode
        if fingers[1] == 1 and fingers[2] == 1:
            #12. find distance between fingers
            lengh, img, lineInfo = detector.findDistance(4, 8, img)
            print(lengh)

            # 10. click mouse if distance short
            if lengh < 40:
                #if wCam - frameR // 2 < z1[0] < wCam + frameR // 2 and hCam - frameR // 2 < z1[1] < hCam + frameR // 2:
                    #wCam, hCam = z1
                cv2.circle(img, (lineInfo[4], lineInfo[5]), 15, (8, 255, 0), cv2.FILLED)
                    # autopy.mouse.move()
                pyautogui.rightClick()

        # 11 scroll
        """""
        if fingers[1] == 1 and fingers[2] == 1:
         # 12. find distance between fingers
            lengh, img, lineInfo = detector.findDistance(8,20, img)
            print(lengh)

            # 10. click mouse if distance short
            if lengh < 40:
               # if wCam - frameR // 2 < z1[0] < wCam + frameR // 2 and hCam - frameR // 2 < z1[1] < hCam + frameR // 2:
               # wCam, hCam = z1
               cv2.circle(img, (lineInfo[4], lineInfo[5]), 15, (8, 255, 0), cv2.FILLED)
               # autopy.mouse.move()
               pyautogui.scroll("click")
        """""








    cv2.imshow("img", img)

    if cv2.waitKey(1) & 0xff == ord('q'):
        cap.release()
        cv2.destroyAllWindows()
