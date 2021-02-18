-- Apartments
INSERT INTO public.apartments (id, name, price, photo_url) VALUES (2, '353', 55, '../asset/offer/apartments/6.jpg');
INSERT INTO public.apartments (id, name, price, photo_url) VALUES (3, 'źółć', 335, '../asset/offer/apartments/3.jpg');

-- Apartments Types Groups
INSERT INTO public.apartments_type_groups (id, name) VALUES (1, 'Rodzaj');

-- Apartments Types
INSERT INTO public.apartments_types (id, type, group_id) VALUES (1, 'Dla dwojga', 1);
INSERT INTO public.apartments_types (id, type, group_id) VALUES (2, 'Z mini barem', 1);
INSERT INTO public.apartments_types (id, type, group_id) VALUES (3, 'Królewski', 1);
INSERT INTO public.apartments_types (id, type, group_id) VALUES (4, 'Książęcy', 1);

-- Apartments Relations
INSERT INTO public.apartments_relations (id, apartment_id, apartment_type_id) VALUES (1, 2, 3);
INSERT INTO public.apartments_relations (id, apartment_id, apartment_type_id) VALUES (2, 3, 2);

-- Conference Rooms
INSERT INTO public.conference_rooms (id, name, price, photo_url) VALUES (1, 'Pierwszy', 10, 'costam');
INSERT INTO public.conference_rooms (id, name, price, photo_url) VALUES (2, 'Drugi', 20, 'costam');
INSERT INTO public.conference_rooms (id, name, price, photo_url) VALUES (3, 'Trzeci', 30, 'costam');
INSERT INTO public.conference_rooms (id, name, price, photo_url) VALUES (4, 'Czwarty', 40, 'costam');
INSERT INTO public.conference_rooms (id, name, price, photo_url) VALUES (5, '353', 88, '../asset/offer/rooms/7.jpg');

-- Conference Types Groups
INSERT INTO public.conference_type_groups (id, name) VALUES (1, 'Ilość osób');
INSERT INTO public.conference_type_groups (id, name) VALUES (2, 'Rzutnik');
INSERT INTO public.conference_type_groups (id, name) VALUES (3, 'Toaleta na sali konferencyjnej');
INSERT INTO public.conference_type_groups (id, name) VALUES (4, 'Rodzaj siedzeń');

-- Conference Types
INSERT INTO public.conference_types (id, type, group_id) VALUES (1, 'Do 10 osób', 1);
INSERT INTO public.conference_types (id, type, group_id) VALUES (2, 'Do 25 osób', 1);
INSERT INTO public.conference_types (id, type, group_id) VALUES (3, 'Do 50 osób', 1);
INSERT INTO public.conference_types (id, type, group_id) VALUES (4, 'Do 100 osób', 1);
INSERT INTO public.conference_types (id, type, group_id) VALUES (5, 'Do 250 osób', 1);
INSERT INTO public.conference_types (id, type, group_id) VALUES (6, 'Do 500 osób', 1);
INSERT INTO public.conference_types (id, type, group_id) VALUES (7, 'Ma rzutnik', 2);
INSERT INTO public.conference_types (id, type, group_id) VALUES (8, 'Nie ma rzutnika', 2);
INSERT INTO public.conference_types (id, type, group_id) VALUES (10, 'Jest toaleta', 3);
INSERT INTO public.conference_types (id, type, group_id) VALUES (11, 'Nie ma tolety', 3);
INSERT INTO public.conference_types (id, type, group_id) VALUES (12, 'Do 750 osob', 1);
INSERT INTO public.conference_types (id, type, group_id) VALUES (13, 'Skórzane fotele', 4);
INSERT INTO public.conference_types (id, type, group_id) VALUES (14, 'Drewniane krzesła', 4);

-- Conference Rooms Relations
INSERT INTO public.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (1, 5, 3);
INSERT INTO public.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (2, 5, 2);
INSERT INTO public.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (3, 5, 13);
INSERT INTO public.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (4, 1, 3);
INSERT INTO public.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (5, 1, 1);
INSERT INTO public.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (6, 1, 13);
INSERT INTO public.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (7, 2, 13);
INSERT INTO public.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (8, 3, 3);
INSERT INTO public.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (9, 3, 1);
INSERT INTO public.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (10, 3, 13);
INSERT INTO public.conference_room_relations (id, conference_room_id, conference_type_id) VALUES (11, 3, 7);

-- Rooms
INSERT INTO public.rooms (id, name, price, photo_url) VALUES (12, 'zamoreł', 45, '../asset/offer/rooms/2.jpg');

-- Rooms Types Groups
INSERT INTO public.rooms_type_groups (id, name) VALUES (1, 'Ilość osób');

-- Rooms Types
INSERT INTO public.rooms_types (id, type, group_id) VALUES (1, 'Jednoosobowy', 1);
INSERT INTO public.rooms_types (id, type, group_id) VALUES (2, 'Dwuosobowy', 1);
INSERT INTO public.rooms_types (id, type, group_id) VALUES (3, 'Trzyosobowy', 1);
INSERT INTO public.rooms_types (id, type, group_id) VALUES (4, 'Czteroosobowy', 1);

-- Rooms Relations
INSERT INTO public.rooms_relations (id, room_id, room_type_id) VALUES (1, 12, 1);

-- Users
INSERT INTO public.users (id, name, password) VALUES (1, 'admin', '1841ff7291b3b51d50e5557acf7e8db67983b0ceabc293b66a55de7330eae5a3f1c88d75092f44d7daac2f084bf0e3f22d57c1cf050887c6fa27661422106111');

-- Reservation Types
INSERT INTO public.reservation_types (id, type) VALUES (1, 'apartment');
INSERT INTO public.reservation_types (id, type) VALUES (2, 'conference-room');
INSERT INTO public.reservation_types (id, type) VALUES (3, 'room');

-- Payment Types
INSERT INTO public.payment_types (id, type) VALUES (1, 'cash');
INSERT INTO public.payment_types (id, type) VALUES (2, 'card');
