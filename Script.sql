CREATE TABLE
    users (
        id INT auto_increment primary key,
        username varchar(100),
        email varchar(100),
        password varchar(100),
        Role ENUM ('author', 'admin') DEFAULT 'author'
    );

CREATE TABLE
    categories (
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
    wikiTag (wikiID INT, tagID INT);

ALTER TABLE wikiTag ADD FOREIGN KEY (wikiID) REFERENCES wikis (id),
ADD FOREIGN KEY (tagID) REFERENCES tags (id);

ALTER TABLE wikis ADD FOREIGN KEY (authorID) REFERENCES users (id),
ADD FOREIGN KEY (CategorieID) REFERENCES categories (id);

INSERT INTO
    wikis (
        title,
        description,
        content,
        authorID,
        CategorieID
    )
VALUES
    (
        'The Future of AI',
        'Exploring the advancements in AI',
        'Artificial Intelligence (AI) is...',
        1,
        1
    ),
    (
        'Quantum Physics Basics',
        'Introduction to Quantum Physics',
        'Quantum physics is the field of physics...',
        3,
        2
    ),
    (
        'The Roman Empire',
        'Overview of the Roman Empire',
        'The Roman Empire was...',
        2,
        3
    );

INSERT INTO
    users (username, email, password, Role)
VALUES
    (
        'johndoe',
        'johndoe@example.com',
        'password123',
        'author'
    ),
    (
        'janedoe',
        'janedoe@example.com',
        'password123',
        'admin'
    ),
    (
        'alexsmith',
        'alexsmith@example.com',
        'password123',
        'author'
    );

INSERT INTO
    categories (Nom)
VALUES
    ('Technology'),
    ('Science'),
    ('History');

INSERT INTO
    tags (Nom)
VALUES
    ('AI'),
    ('Quantum Mechanics'),
    ('Roman History');

INSERT INTO
    wikiTag (wikiID, tagID)
VALUES
    (1, 1),
    (2, 2),
    (3, 3);

-- search query
SELECT
    *,
    wikis.id as wikiID
FROM
    wikis
    JOIN users ON wikis.authorID = users.id
WHERE
    title LIKE '%$search%'
    OR description LIKE '%$search%'
    OR content LIKE '%$search%'
LIMIT
    3
OFFSET
    2;