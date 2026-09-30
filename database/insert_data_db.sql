USE `librarie`;

-- ============================================
-- 1. DOMENII
-- ============================================
SET NAMES utf8mb4;
INSERT INTO `domenii` (`nume_domeniu`) VALUES
('Literatură română'),
('Literatură universală'),
('Informatică'),
('Istorie'),
('Psihologie'),
('Știință'),
('Economie și afaceri'),
('Dezvoltare personală');


-- ============================================
-- 2. AUTORI
-- ============================================

INSERT INTO `autori` (`nume_autor`) VALUES
('Mihai Eminescu'),
('Ion Creangă'),
('Liviu Rebreanu'),
('George Orwell'),
('Fyodor Dostoevsky'),
('Robert C. Martin'),
('Yuval Noah Harari'),
('Daniel Kahneman'),
('Dale Carnegie'),
('Eric Ries');


-- ============================================
-- 3. CARTI
-- ============================================
-- id_domeniu:
-- 1 = Literatura romana
-- 2 = Literatura universala
-- 3 = Informatica
-- 4 = Istorie
-- 5 = Psihologie
-- 6 = Stiinta
-- 7 = Economie si afaceri
-- 8 = Dezvoltare personala

INSERT INTO `carti`
(`id_autor`, `id_domeniu`, `titlu`, `descriere`, `pret`, `data`)
VALUES

(1, 1,
 'Poezii',
 'O selecție de poezii reprezentative din opera lui Mihai Eminescu.',
 29.90,
 '2026-01-10 10:00:00'),

(2, 1,
 'Amintiri din copilărie',
 'Una dintre cele mai cunoscute opere ale literaturii române.',
 34.50,
 '2026-02-15 11:30:00'),

(3, 1,
 'Ion',
 'Roman clasic al literaturii române, scris de Liviu Rebreanu.',
 42.00,
 '2026-03-01 09:15:00'),

(4, 2,
 '1984',
 'Roman distopic despre o societate totalitară și controlul exercitat asupra individului.',
 39.90,
 '2026-03-12 14:20:00'),

(5, 2,
 'Crimă și pedeapsă',
 'Roman clasic care explorează vinovăția, moralitatea și natura umană.',
 54.90,
 '2026-04-05 16:45:00'),

(6, 3,
 'Clean Code',
 'Principii și practici pentru scrierea unui cod software mai clar și mai ușor de întreținut.',
 89.90,
 '2026-04-20 12:00:00'),

(7, 4,
 'Sapiens',
 'O incursiune în istoria și evoluția speciei umane.',
 64.50,
 '2026-05-10 10:30:00'),

(8, 5,
 'Gândire rapidă, gândire lentă',
 'O introducere în mecanismele prin care oamenii iau decizii și fac judecăți.',
 59.90,
 '2026-06-01 15:00:00'),

(9, 8,
 'Secretele succesului',
 'Principii clasice despre comunicare și relațiile interpersonale.',
 44.90,
 '2026-07-12 09:45:00'),

(10, 7,
 'The Lean Startup',
 'Metode pentru dezvoltarea și validarea rapidă a ideilor de afaceri.',
 69.00,
 '2026-08-20 13:15:00');


-- ============================================
-- 4. COMENTARII
-- ============================================

INSERT INTO `comentarii`
(`id_carte`, `nume_utilizator`, `adresa_email`, `comentariu`)
VALUES

(1, 'Andrei Popescu', 'andrei@example.com',
 'O colecție foarte frumoasă. Recomand iubitorilor de poezie.'),

(2, 'Maria Ionescu', 'maria@example.com',
 'Una dintre cărțile mele preferate din literatura română.'),

(4, 'Alex Dumitru', 'alex@example.com',
 'Un roman care rămâne surprinzător de actual.'),

(6, 'Cristian Matei', 'cristian@example.com',
 'Foarte utilă pentru programatori. Exemplele sunt ușor de urmărit.'),

(6, 'Radu Stan', 'radu@example.com',
 'Recomand cartea celor care vor să își îmbunătățească stilul de programare.'),

(7, 'Ioana Pavel', 'ioana@example.com',
 'O perspectivă interesantă asupra istoriei umanității.'),

(8, 'Marius Ene', 'marius@example.com',
 'Interesantă, dar necesită puțină răbdare pentru a fi parcursă.'),

(10, 'Elena Tudor', 'elena@example.com',
 'Foarte bună pentru cei interesați de antreprenoriat.');


-- ============================================
-- 5. VANZARI
-- ============================================

INSERT INTO `vanzari`
(`id_carte`, `nr_buc`)
VALUES
(1, 2),
(2, 1),
(4, 3),
(6, 2),
(7, 1),
(8, 2),
(10, 4);


-- ============================================
-- 6. ADMIN
-- ============================================
-- Pentru versiunea VECHE a site-ului, care foloseste MD5:

INSERT INTO `admin`
(`admin_nume`, `admin_parola`)
VALUES
('admin', '$2y$12$X11o3sm7jspb5f7OgoIYGu35xY8XqJeQRMXDRsNTvwiCOdy6leI8m');