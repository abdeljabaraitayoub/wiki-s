CREATE TABLE
    users (
        id INT auto_increment primary key,
        username varchar(100),
        email varchar(100),
        password varchar(100),
        Role ENUM ('author', 'admin') DEFAULT 'author'
    );

CREATE TABLE categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        Nom VARCHAR(255) NOT NULL
    );

CREATE TABLE
    wikis (
        id INT auto_increment primary key,
        title varchar(100),
        description varchar(100),
        content text,
        creationDate DATETIME DEFAULT CURRENT_TIMESTAMP,
        updateDate DATETIME,
        authorID INT,
        CategorieID INT
    );

CREATE TABLE
    tags (
        id INT AUTO_INCREMENT PRIMARY KEY,
        Nom VARCHAR(255) NOT NULL
    );

CREATE TABLE
    wikiTag (
        wikiID INT, 
        tagID INT
        );

ALTER TABLE wikiTag ADD FOREIGN KEY (wikiID) REFERENCES wikis (id),
ADD FOREIGN KEY (tagID) REFERENCES tags (id);

ALTER TABLE wikis ADD FOREIGN KEY (authorID) REFERENCES users (id),
ADD FOREIGN KEY (CategorieID) REFERENCES categories (id);