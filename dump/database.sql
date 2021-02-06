create table apartments
(
  id        int(255) auto_increment
    primary key,
  name      varchar(255) not null,
  price     int(255)     not null,
  photo_url text         not null
)
  collate = utf8_bin;

INSERT INTO `database`.apartments (id, name, price, photo_url) VALUES (2, '353', 55, '../asset/offer/apartments/6.jpg');
INSERT INTO `database`.apartments (id, name, price, photo_url) VALUES (3, 'źółć', 335, '../asset/offer/apartments/3.jpg');

create table apartments_relations
(
  id                int unsigned auto_increment
    primary key,
  apartment_id      int null,
  apartment_type_id int null
);

INSERT INTO `database`.apartments_relations (id, apartment_id, apartment_type_id) VALUES (1, 2, 3);
INSERT INTO `database`.apartments_relations (id, apartment_id, apartment_type_id) VALUES (2, 3, 2);

create table apartments_type_groups
(
  id   int unsigned auto_increment
    primary key,
  name text null
);

INSERT INTO `database`.apartments_type_groups (id, name) VALUES (1, 'Rodzaj');

create table apartments_types
(
  id       int auto_increment
    primary key,
  type     varchar(255) not null,
  group_id int          null
)
  collate = utf8_bin;

INSERT INTO `database`.apartments_types (id, type, group_id) VALUES (1, 'Dla dwojga', 1);
INSERT INTO `database`.apartments_types (id, type, group_id) VALUES (2, 'Z mini barem', 1);
INSERT INTO `database`.apartments_types (id, type, group_id) VALUES (3, 'Królewski', 1);
INSERT INTO `database`.apartments_types (id, type, group_id) VALUES (4, 'Książęcy', 1);

create table conference_room_relations
(
  id                 int unsigned auto_increment
    primary key,
  conference_room_id int null,
  conference_type_id int null
);

INSERT INTO `database`.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (1, 5, 3);
INSERT INTO `database`.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (2, 5, 2);
INSERT INTO `database`.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (3, 5, 13);
INSERT INTO `database`.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (4, 1, 3);
INSERT INTO `database`.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (5, 1, 1);
INSERT INTO `database`.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (6, 1, 13);
INSERT INTO `database`.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (7, 2, 13);
INSERT INTO `database`.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (8, 3, 3);
INSERT INTO `database`.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (9, 3, 1);
INSERT INTO `database`.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (10, 3, 13);
INSERT INTO `database`.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (11, 3, 7);

create table conference_rooms
(
  id        int auto_increment
    primary key,
  name      varchar(255) not null,
  price     int          not null,
  photo_url text         not null
)
  collate = utf8_bin;

INSERT INTO `database`.conference_rooms (id, name, price, photo_url) VALUES (1, 'Pierwszy', 10, 'costam');
INSERT INTO `database`.conference_rooms (id, name, price, photo_url) VALUES (2, 'Drugi', 20, 'costam');
INSERT INTO `database`.conference_rooms (id, name, price, photo_url) VALUES (3, 'Trzeci', 30, 'costam');
INSERT INTO `database`.conference_rooms (id, name, price, photo_url) VALUES (4, 'Czwarty', 40, 'costam');
INSERT INTO `database`.conference_rooms (id, name, price, photo_url) VALUES (5, '353', 88, '../asset/offer/rooms/7.jpg');

create table conference_type_groups
(
  id   int unsigned auto_increment
    primary key,
  name text null
);

INSERT INTO `database`.conference_type_groups (id, name) VALUES (1, 'Ilość osób');
INSERT INTO `database`.conference_type_groups (id, name) VALUES (2, 'Rzutnik');
INSERT INTO `database`.conference_type_groups (id, name) VALUES (3, 'Toaleta na sali konferencyjnej');
INSERT INTO `database`.conference_type_groups (id, name) VALUES (4, 'Rodzaj siedzeń');

create table conference_types
(
  id       int auto_increment
    primary key,
  type     text not null,
  group_id int  null
)
  collate = utf8_bin;

INSERT INTO `database`.conference_types (id, type, group_id) VALUES (1, 'Do 10 osób', 1);
INSERT INTO `database`.conference_types (id, type, group_id) VALUES (2, 'Do 25 osób', 1);
INSERT INTO `database`.conference_types (id, type, group_id) VALUES (3, 'Do 50 osób', 1);
INSERT INTO `database`.conference_types (id, type, group_id) VALUES (4, 'Do 100 osób', 1);
INSERT INTO `database`.conference_types (id, type, group_id) VALUES (5, 'Do 250 osób', 1);
INSERT INTO `database`.conference_types (id, type, group_id) VALUES (6, 'Do 500 osób', 1);
INSERT INTO `database`.conference_types (id, type, group_id) VALUES (7, 'Ma rzutnik', 2);
INSERT INTO `database`.conference_types (id, type, group_id) VALUES (8, 'Nie ma rzutnika', 2);
INSERT INTO `database`.conference_types (id, type, group_id) VALUES (10, 'Jest toaleta', 3);
INSERT INTO `database`.conference_types (id, type, group_id) VALUES (11, 'Nie ma tolety', 3);
INSERT INTO `database`.conference_types (id, type, group_id) VALUES (12, 'Do 750 osob', 1);
INSERT INTO `database`.conference_types (id, type, group_id) VALUES (13, 'Skórzane fotele', 4);
INSERT INTO `database`.conference_types (id, type, group_id) VALUES (14, 'Drewniane krzesła', 4);

create table reservation_types
(
  id   int auto_increment
    primary key,
  type varchar(255) not null
)
  collate = utf8_bin;

create table reservations
(
  id                    int auto_increment
    primary key,
  client_id             int          not null,
  type                  int          not null,
  date_from             date         not null,
  date_to               date         not null,
  payment_type          int          not null,
  reservation_object_id varchar(255) not null
)
  collate = utf8_bin;

create table rooms
(
  id        int(255) auto_increment
    primary key,
  name      varchar(255) not null,
  price     int(255)     not null,
  photo_url text         not null
)
  collate = utf8_bin;

INSERT INTO `database`.rooms (id, name, price, photo_url) VALUES (12, 'zamoreł', 45, '../asset/offer/rooms/2.jpg');

create table rooms_relations
(
  id           int unsigned auto_increment
    primary key,
  room_id      int null,
  room_type_id int null
);

INSERT INTO `database`.rooms_relations (id, room_id, room_type_id) VALUES (1, 12, 1);

create table rooms_type_groups
(
  id   int unsigned auto_increment
    primary key,
  name text null
);

INSERT INTO `database`.rooms_type_groups (id, name) VALUES (1, 'Ilość osób');

create table rooms_types
(
  id       int(255) auto_increment
    primary key,
  type     varchar(255) not null,
  group_id int          null
)
  collate = utf8_bin;

INSERT INTO `database`.rooms_types (id, type, group_id) VALUES (1, 'Jednoosobowy', 1);
INSERT INTO `database`.rooms_types (id, type, group_id) VALUES (2, 'Dwuosobowy', 1);
INSERT INTO `database`.rooms_types (id, type, group_id) VALUES (3, 'Trzyosobowy', 1);
INSERT INTO `database`.rooms_types (id, type, group_id) VALUES (4, 'Czteroosobowy', 1);

create table users
(
  id       int auto_increment
    primary key,
  name     varchar(50)  not null,
  password varchar(255) not null
)
  collate = utf8_bin;

INSERT INTO `database`.users (id, name, password) VALUES (1, 'admin', '1841ff7291b3b51d50e5557acf7e8db67983b0ceabc293b66a55de7330eae5a3f1c88d75092f44d7daac2f084bf0e3f22d57c1cf050887c6fa27661422106111');
