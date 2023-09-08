from tkinter import *
from PIL import ImageTk
import pymysql
from tkinter import messagebox
import cv2

#Functionality Part
def login_user():
    if usernameEntry.get() == '' or passwordEntry.get() == '':
        messagebox.showerror('Error', 'All Fields Are Required')

    else:
        try:
            con = pymysql.connect(host='localhost', user='root', password='Divinelove1$')
            mycursor = con.cursor()
        except:
            messagebox.showerror('Error', 'Connection is not established try again')
            return
        query= 'use userdata'
        mycursor.execute(query)
        query='select * from data where username=%s and password=%s'
        mycursor.execute(query,(usernameEntry.get(),passwordEntry.get()))
        row=mycursor.fetchone()
        if row==None:
            messagebox.showerror('Error', 'Invalid username or password')
        else:
            login_window.destroy()
            # messagebox.showerror('Welcome','Login is sucessful')
            import video


def sign_page():
    login_window.destroy()
    import Signup

def user_enter(event):
    if usernameEntry.get()=='Username':
        usernameEntry.delete(0,END)

def password_enter(event):
    if passwordEntry.get()=='Password':
        passwordEntry.delete(0,END)

def hide():
    openeye.config(file='images/resize2.png')
    passwordEntry.config(show='*')

    eyeButton.config(command=show)

def show():
    openeye.config(file='images/openeyes2.png')
    passwordEntry.config(show='')
    eyeButton.config(command=hide)








#GUI PART
login_window = Tk()

login_window.geometry('990x660+50+50')
#login_window.resizable(0, 0)
login_window.title('LOGIN')
bgImage = ImageTk.PhotoImage(file='images/burger.jpg')

bgLabel = Label(login_window, image=bgImage)
bgLabel.place(x=0, y=0)

heading=Label(login_window, text='User Login', font=('Microsoft Yahei UI Light',23,'bold'),bg='white',fg='firebrick1')
heading.place(x=685,y=120)

usernameEntry= Entry(login_window,width=25,font=('Microsoft Yahei UI Light',  11,'bold'),
                       bd=0,fg='firebrick1')
usernameEntry.place(x=580, y=200)
usernameEntry.insert(0,'Username')

usernameEntry.bind('<FocusIn>',user_enter)
Frame(login_window,width=227, height=2,bg='firebrick1').place(x=580, y=222)


passwordEntry= Entry(login_window,width=25,font=('Microsoft Yahei UI Light',  11,'bold'),
                       bd=0,fg='firebrick1')
passwordEntry.place(x=580, y=260)
passwordEntry.insert(0,'Password')

passwordEntry.bind('<FocusIn>',password_enter)
Frame(login_window,width=227, height=2,bg='firebrick1').place(x=580, y=282)

openeye=PhotoImage(file='images/openeyes2.png')
eyeButton= Button(login_window, image= openeye,bd=0,bg='white', activebackground='white',
                  cursor='hand2',command=hide)

eyeButton.place(x=786,y=260)


forgetButton= Button(login_window, text='Forget Password',bd=0,bg='white', activebackground='white',
                  cursor='hand2',font=('Microsoft Yahei UI Light',9,'bold'),fg='firebrick1', activeforeground='firebrick1')

forgetButton.place(x=695,y=295)

loginButton=Button(login_window,text='Login', font=('Open sans',16,'bold'), fg=
                                                    'white',bg='firebrick1',activeforeground='white', activebackground='firebrick1', cursor='hand2', bd=0,width=17,command=login_user)

loginButton.place(x=578,y=350)

orLabel=Label(login_window, text='--------------OR--------------', font=('open sans',16),fg='firebrick1')
orLabel.place( x=580,y=400)

signupLabel=Label(login_window, text='Dont have an account?', font=('open sans',9,'bold'),fg='firebrick1')
signupLabel.place( x=590,y=500)

newaccountButton = Button(login_window,text='Create new one', font=('Open sans',9,'bold','underline'), fg=
                                                    'blue',bg='white',activeforeground='blue', activebackground='white', cursor='hand2', bd=0, command=sign_page)
newaccountButton.place(x=727,y=500)
login_window.mainloop()




