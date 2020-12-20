PRAGMA foreign_keys = ON;

CREATE TABLE account (
  id INTEGER PRIMARY KEY,
  email TEXT UNIQUE NOT NULL,
  password TEXT NOT NULL,
  bio TEXT
);

CREATE TABLE location (
  id INTEGER PRIMARY KEY,
  city TEXT NOT NULL,
  district TEXT NOT NULL
);


CREATE TABLE shelter (
  shelter_id INTEGER PRIMARY KEY,
  name TEXT NOT NULL,
  account_id INTEGER NOT NULL,
  location_id INTEGER NOT NULL,
  FOREIGN KEY (account_id) REFERENCES account(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (location_id) REFERENCES location(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE person (
  person_id INTEGER PRIMARY KEY,
  name TEXT NOT NULL,
  account_id INTEGER NOT NULL,
  location_id INTEGER NOT NULL,
  works_at INTEGER,
  FOREIGN KEY (account_id) REFERENCES account(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (location_id) REFERENCES location(id) ON DELETE SET NULL ON UPDATE CASCADE,
  FOREIGN KEY (works_at) REFERENCES shelter(shelter_id) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE breed(
  id INTEGER PRIMARY KEY,
  species TEXT NOT NULL,
  name TEXT NOT NULL
);

CREATE TABLE pet (
  id INTEGER PRIMARY KEY,
  name TEXT,
  bio TEXT,
  gender TEXT,
  weight REAL,
  height REAL,
  color TEXT,
  breed_id INTEGER,
  has_for_adoption INTEGER,
  adopted INTEGER,
  FOREIGN KEY (breed_id) REFERENCES breed(id) ON DELETE SET NULL ON UPDATE CASCADE,
  FOREIGN KEY (has_for_adoption) REFERENCES account(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (adopted) REFERENCES account(id) ON DELETE CASCADE ON UPDATE CASCADE
);

create TABLE favourite(
  pet_id INTEGER NOT NULL,
  person_id INTEGER NOT NULL,
  FOREIGN KEY (pet_id) REFERENCES pet(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (person_id) REFERENCES person(person_id) ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY (pet_id,person_id)
);

create TABLE questions(
  id INTEGER PRIMARY KEY,
  question TEXT,
  response TEXT,
  question_date TEXT,
  answer_date TEXT,
  made_by INTEGER,
  answered_by INTEGER,
  about INTEGER,
  FOREIGN KEY (made_by) REFERENCES account(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (answered_by) REFERENCES account(id) ON DELETE SET NULL ON UPDATE CASCADE,
  FOREIGN KEY (about) REFERENCES pet(id) ON DELETE CASCADE ON UPDATE CASCADE
);

create TABLE proposal(
  id INTEGER PRIMARY KEY,
  status INTEGER,
  date TEXT,
  pet_id INTEGER,
  made_adoption_proposal INTEGER,
  recv_adoption_proposal INTEGER,
  FOREIGN KEY (pet_id) REFERENCES pet(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (made_adoption_proposal) REFERENCES account(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (recv_adoption_proposal) REFERENCES account(id) ON DELETE CASCADE ON UPDATE CASCADE
);
