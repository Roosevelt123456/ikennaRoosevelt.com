from tkinter  import *

import pymysql
from PIL import ImageTk
from tkinter import messagebox

### clear all message
def clear():
    emailEntry.delete(0,END)
    usernameEntry.delete(0,END)
    passwordEntry.delete(0,END)
    confirmEntry.delete(0,END)
    check.set(0)
    signup_window.destroy()
    import Signin


##database
def connect_database():
    if emailEntry.get()=='' or usernameEntry.get()=='' or passwordEntry.get()==''or confirmEntry.get()=='':
        messagebox.showerror('Error','all Fields Are Required')
    elif passwordEntry.get() != confirmEntry.get():
        messagebox.showerror('Error','Password Missmatch')
    elif check.get()==0:
        messagebox.showerror('Error','Please Accept Terms & Conditions')

    else:
        try:
            con=pymysql.Connect(host='localhost', user='root', password='Divinelove1$')
            mycursor=con.cursor()
        except:
            messagebox.showerror('Error', 'Database Connectivity Issue,Please Try again')
            return
        try:
            query='create database userdata'
            mycursor.execute(query)
            query='use userdata'
            mycursor.execute(query)
            query='create table data(id int auto_increment primary key not null, email varchar(50),username varchar(100),password varchar(20))'
            mycursor.execute(query)
        except:
            mycursor.execute('use userdata')
            ## if username is same
            query='select * from data where username=%s'
            mycursor.execute(query,(usernameEntry.get()))
            row=mycursor.fetchone()
            if row != None:
                messagebox.showerror('Error', 'Username Already Exists')

            else:

                ## insert into dey database
                query='insert into data(email,username,password) values(%s,%s,%s)'

                mycursor.execute(query,(emailEntry.get(),usernameEntry.get(),passwordEntry.get()))
                con.commit()
                con.close()
                messagebox.showinfo('sucess', 'Registration is successfull')

                clear()
                signup_window.destroy()
                import Signin






###
def login_page():
    signup_window.destroy()
    import Signin




signup_window= Tk()
signup_window.title('Signup Page')
#signup_window.resizable(False,False)
background= ImageTk.PhotoImage(file='images/bg.jpg')
bgLabel=Label(signup_window,image=background)
bgLabel.grid()

frame=Frame(signup_window)
frame.place(x=680,y=100)
heading=Label(frame, width=30,text='CREATE AN ACCOUNT', font=('Microsoft Yahei UI Light',10 ,'bold'),bg='white',fg='firebrick1')
heading.grid(row=0, column=0, padx=10, pady=10)

emailLabel=Label(frame, text='Email', font=('Microsoft Yahei UI Light',10 ,'bold'),bg='white',fg='firebrick1')

emailLabel.grid(row=1,column=0, sticky='w', padx=25, pady=(10,10))
emailEntry=Entry(frame, width=30, text='Email', font=('Microsoft Yahei UI Light',18 ,'bold'),bg='firebrick1',fg='white')
emailEntry.grid(row=2, column=0, sticky='w',padx=25)


#####
usernameLabel=Label(frame, text='Username', font=('Microsoft Yahei UI Light',10 ,'bold'),bg='white',fg='firebrick1')

usernameLabel.grid(row=3,column=0, sticky='w',padx=25,pady=(10,10))
usernameEntry=Entry(frame,width=30, text='Username', font=('Microsoft Yahei UI Light',18 ,'bold'),bg='firebrick1',fg='white')
usernameEntry.grid(row=4, column=0, sticky='w',padx=25)
###########
passwordLabel=Label(frame, text='Password', font=('Microsoft Yahei UI Light',10 ,'bold'),bg='white',fg='firebrick1')

passwordLabel.grid(row=5,column=0, sticky='w',padx=25,pady=10)
passwordEntry=Entry(frame,width=30, text='Password', font=('Microsoft Yahei UI Light',18 ,'bold'),bg='firebrick1',fg='white')
passwordEntry.grid(row=6, column=0, sticky='w',padx=25)

###########
confirmLabel=Label(frame, text='Confirm Password', font=('Microsoft Yahei UI Light',10 ,'bold'),bg='white',fg='firebrick1')

confirmLabel.grid(row=7,column=0, sticky='w',padx=25,pady=10)
confirmEntry=Entry(frame,width=30, text='Confirm Password', font=('Microsoft Yahei UI Light',18 ,'bold'),bg='firebrick1',fg='white')
confirmEntry.grid(row=8, column=0, sticky='w',padx=25)
#######
check=IntVar()
ternsandconditions= Checkbutton(frame, text='I agree to the Terms & Conditions', font=('Microsoft Yahei UI Light',15 ,'bold'),
                                fg='firebrick1', bg='white', activeforeground='firebrick1',
                                cursor='hand2',width=30, variable=check)
ternsandconditions.grid(row=9, column=0,pady=10, padx=15)

################
signupButton= Button(frame, text='Signup',bd=0,bg='firebrick1', activebackground='firebrick1',
                  cursor='hand2',font=('open sans',16,'bold'),fg='white', activeforeground='white', width=30, command=connect_database)

signupButton.grid(row=10,column=0, pady=10)
######
alreadyaccount=Label(frame, text='Dont have an account?', font=('open sans',9,'bold'),fg='firebrick1')
alreadyaccount.grid(row=11,column=0,sticky='w',padx=25,pady=10)

logintButton = Button(frame,text='Create new one', font=('Open sans',9,'bold','underline'), fg=
                                                    'blue',bg='white',activeforeground='blue', activebackground='white',
                      cursor='hand2', bd=0, command=login_page)
logintButton.place(x=170, y=490)




signup_window.mainloop()
