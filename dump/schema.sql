CREATE TABLE public.apartments
(
  id SERIAL PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  price INT NOT NULL,
  photo_url TEXT NOT NULL
);
CREATE TABLE public.apartments_type_groups
(
  id SERIAL PRIMARY KEY,
  name VARCHAR(255) NOT NULL
);
CREATE TABLE public.apartments_types
(
  id SERIAL PRIMARY KEY,
  type VARCHAR(255) NOT NULL,
  group_id INT REFERENCES public.apartments_type_groups("id") NOT NULL
);
CREATE TABLE public.apartments_relations
(
  id SERIAL PRIMARY KEY,
  apartment_id INT REFERENCES public.apartments("id") NOT NULL,
  apartment_type_id INT REFERENCES public.apartments_types("id") NOT NULL
);

CREATE TABLE public.conference_rooms
(
  id SERIAL PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  price INT NOT NULL,
  photo_url TEXT NOT NULL
);
CREATE TABLE public.conference_type_groups
(
  id SERIAL PRIMARY KEY,
  name VARCHAR(255) NOT NULL
);
CREATE TABLE public.conference_types
(
  id SERIAL PRIMARY KEY,
  type VARCHAR(255) NOT NULL,
  group_id INT REFERENCES public.conference_type_groups("id") NOT NULL
);
CREATE TABLE public.conference_room_relations
(
  id SERIAL PRIMARY KEY,
  conference_room_id INT REFERENCES public.conference_rooms("id") NOT NULL,
  conference_type_id INT REFERENCES public.conference_types("id") NOT NULL
);

CREATE TABLE public.rooms
(
  id SERIAL PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  price INT NOT NULL,
  photo_url TEXT NOT NULL
);
CREATE TABLE public.rooms_type_groups
(
  id SERIAL PRIMARY KEY,
  name VARCHAR(255) NOT NULL
);
CREATE TABLE public.rooms_types
(
  id SERIAL PRIMARY KEY,
  type VARCHAR(255) NOT NULL,
  group_id INT REFERENCES public.rooms_type_groups("id") NOT NULL
);
CREATE TABLE public.rooms_relations
(
  id SERIAL PRIMARY KEY,
  room_id INT REFERENCES public.rooms("id") NOT NULL,
  room_type_id INT REFERENCES public.rooms_types("id") NOT NULL
);

CREATE TABLE public.reservation_types
(
  id SERIAL PRIMARY KEY,
  type VARCHAR(255) NOT NULL
);
CREATE TABLE public.reservations
(
  id SERIAL PRIMARY KEY,
  client_id INT NOT NULL,
  type INT REFERENCES public.reservation_types("id") NOT NULL,
  date_from DATE NOT NULL,
  date_to DATE NOT NULL,
  payment_type INT NOT NULL,
  reservation_object_id VARCHAR(255) NOT NULL
);

CREATE TABLE public.users
(
  id SERIAL PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL
);
