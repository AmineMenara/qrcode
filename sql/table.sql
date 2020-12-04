CREATE TABLE QRCODE(
    LABEL_0 VARCHAR(50),
    STATUS_0 INT
)

INSERT INTO QRCODE (LABEL_0, STATUS_0) VALUES ('http://fr.wikipedia.org/', 0);
INSERT INTO QRCODE (LABEL_0, STATUS_0) VALUES ('https://www.kaspersky.com', 0);
INSERT INTO QRCODE (LABEL_0, STATUS_0) VALUES ('http://www.lyc-stex-mantes.ac-versailles.fr/tice/', 0);
INSERT INTO QRCODE (LABEL_0, STATUS_0) VALUES ('http://www.qrcode-monkey.com', 0);

SELECT * FROM QRCODE;
