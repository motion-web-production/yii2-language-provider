PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: language
DROP TABLE IF EXISTS language;

CREATE TABLE language(
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  label STRING,
  locale STRING,
  is_default BOOLEAN DEFAULT false
);

INSERT INTO language ('label', 'locale', 'is_default')
VALUES
  ('english', 'en', '1'),
  ('russian', 'ru', '0');

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;