SELECT * FROM `transaction` WHERE date(timestamp) = '2021-06-14'

SELECT T.uid , S.product , S.cost , T.total , T.quantity , S.brand FROM transaction T , stocks S WHERE T.pid=S.pid AND T.uid = "jdvkCvKd9bdpFNSlukFa0D0QIjJ3"

CREATE TABLE transaction (
    uid VARCHAR (70) NOT NULL,
    pid INT,
    quantity VARCHAR (30),
    total INT,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (uid,pid),
    CONSTRAINT user_key FOREIGN KEY (uid) REFERENCES user (uid) ON DELETE CASCADE,
    CONSTRAINT stocks_key FOREIGN KEY (pid) REFERENCES stocks (pid) ON DELETE CASCADE
)