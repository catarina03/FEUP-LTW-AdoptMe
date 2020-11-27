PRAGMA foreign_keys = ON;

CREATE TABLE account (
  id INTEGER PRIMARY KEY,
  email TEXT NOT NULL,
  password TEXT NOT NULL
);

CREATE TABLE location (
  id INTEGER PRIMARY KEY,
  city TEXT,
  district TEXT
);

CREATE TABLE person (
  person_id INTEGER PRIMARY KEY,
  name TEXT,
  account_id INTEGER,
  location_id INTEGER,
  FOREIGN KEY (account_id) REFERENCES account(id),
  FOREIGN KEY (location_id) REFERENCES location(id)
);

CREATE TABLE shelter (
  shelter_id INTEGER PRIMARY KEY,
  name TEXT,
  account_id INTEGER,
  location_id INTEGER,
  FOREIGN KEY (account_id) REFERENCES account(id),
  FOREIGN KEY (location_id) REFERENCES location(id)
);

CREATE TABLE breed(
  id INTEGER PRIMARY KEY,
  type TEXT,
  name TEXT
);

CREATE TABLE pet (
  id INTEGER PRIMARY KEY,
  name TEXT,
  gender TEXT,
  weight REAL,
  height REAL,
  color TEXT,
  breed_id INTEGER,
  has_for_adoption INTEGER,
  adopted INTEGER,
  FOREIGN KEY (breed_id) REFERENCES breed(id),
  FOREIGN KEY (has_for_adoption) REFERENCES account(id),
  FOREIGN KEY (adopted) REFERENCES account(id)
);

create TABLE favourite(
  pet_id INTEGER,
  person_id INTEGER,
  FOREIGN KEY (pet_id) REFERENCES pet(id),
  FOREIGN KEY (person_id) REFERENCES person(person_id),
  PRIMARY KEY (pet_id,person_id)
);