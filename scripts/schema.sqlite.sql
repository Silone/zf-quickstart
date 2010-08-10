CREATE TABLE guestbook (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	email VARCHAR(32) NOT NULL DEFAULT 'no@mail.com',
	comment TEXT NULL,
	created DATETIME NOT NULL
);

CREATE INDEX "id" ON "guestbook" ("id");
