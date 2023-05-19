CREATE TABLE Users (
 user_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
 username VARCHAR(30) NOT NULL UNIQUE,
 passwrd VARCHAR(30) NOT NULL,
 first_name VARCHAR(30) NOT NULL,
 last_name VARCHAR(30) NOT NULL,
 email VARCHAR(254) NOT NULL UNIQUE,
 phone_number VARCHAR(20),
 home_address VARCHAR(50),
 postal_code VARCHAR(15),
 usertype VARCHAR(10) NOT NULL,
 registration_time TIMESTAMP NOT NULL
);

CREATE TABLE Agents (
 agent_id INTEGER NOT NULL PRIMARY KEY REFERENCES Users,
 department_id INTEGER NOT NULL REFERENCES Departments,
 star_points INTEGER NOT NULL
);

CREATE TABLE Admins (
 admin_id INTEGER NOT NULL PRIMARY KEY REFERENCES Users,
 department_id INTEGER NOT NULL UNIQUE REFERENCES Departments,
 star_points INTEGER NOT NULL,
 admin_type VARCHAR(20) NOT NULL
);

CREATE TABLE Departments (
 department_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
 department_name VARCHAR(30) NOT NULL,
 department_admin_id INTEGER NOT NULL REFERENCES Users
);

CREATE TABLE Tickets (
 ticket_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
 client_id INTEGER NOT NULL REFERENCES Clients,
 ticket_title VARCHAR(100) NOT NULL,
 ticket_description VARCHAR NOT NULL,
 ticket_department_id INTEGER NOT NULL,
 ticket_status VARCHAR(15) NOT NULL,
 ticket_register_time TIMESTAMP NOT NULL,
 ticket_priority VARCHAR(15),
 ticket_hashtag VARCHAR(20)
);

CREATE TABLE Messages (
 message_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
 receiver_id INTEGER NOT NULL REFERENCES Users,
 sender_id INTEGER NOT NULL REFERENCES Users,
 content VARCHAR NOT NULL,
 ticket_id INTEGER REFERENCES Tickets,
 time_of_message TIMESTAMP NOT NULL,
 message_hashtag VARCHAR(20)
);

CREATE TABLE Assignments (
 ticket_id INTEGER NOT NULL REFERENCES Tickets,
 user_id INTEGER NOT NULL REFERENCES Users,
 assignment_time TIMESTAMP NOT NULL
 );
 
 CREATE TABLE Admin_Tasks (
  task_type VARCHAR(15) NOT NULL,
  user_id INTEGER NOT NULL REFERENCES Users,
  admin_id INTEGER NOT NULL REFERENCES Admins,
  department_id INTEGER REFERENCES Departments,
  task_time TIMESTAMP NOT NULL,
  task_reason VARCHAR(200)
  );
  
  CREATE TABLE Logins (
  user_id INTEGER NOT NULL PRIMARY KEY REFERENCES Users,
  login_time TIMESTAMP NOT NULL
  );
  
  CREATE TABLE FAQS (
  question_id INTEGER NOT NULL PRIMARY KEY,
  question VARCHAR(50) NOT NULL,
  answer VARCHAR(1000) NOT NULL,
  FAQS_hashtag VARCHAR(20)
  );
  
  CREATE TABLE Files (
  file_id INTEGER NOT NULL PRIMARY KEY,
  file_type VARCHAR(20) NOT NULL,
  file_name VARCHAR(30)
  );
  
  CREATE TABLE Files_Messages (
  file_id INTEGER NOT NULL REFERENCES Files,
  message_id INTEGER NOT NULL REFERENCES Messages
  );

INSERT INTO Departments(department_id,department_name,department_admin_id)
VALUES(745,"Software Technical Support",100651);
INSERT INTO Departments(department_id,department_name,department_admin_id)
VALUES(746,"Hardware Technical Support",100652);
INSERT INTO Departments(department_id,department_name,department_admin_id)
VALUES(747,"Network Support",100653);
INSERT INTO Departments(department_id,department_name,department_admin_id)
VALUES(748,"Costumer Service",100654);
INSERT INTO Departments(department_id,department_name,department_admin_id)
VALUES(749,"Security Issues",100655);
INSERT INTO Departments(department_id,department_name,department_admin_id)
VALUES(750,"Web Development",100656);
INSERT INTO Departments(department_id,department_name,department_admin_id)
VALUES(751,"App Development",100650);
