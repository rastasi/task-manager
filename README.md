# Task Manager

## Indítás

A projekt futtatásához szükség van a következőkre:

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- `make` parancs elérhető a rendszereden

### Lépések:

1. A fejlesztői környezet elindítása:

```
make dev
```

2. Adatbázis migrációk lefuttatása:

```
make migrate
```

3. Példányadatok feltöltése az adatbázisba (biztonságosan többször is futtatható):

```
make seed
```

4. Ezután az olal megtekinthető az alábbi címen:

```
http://localhost:8080
```

## Alkalmazott technológiák

- **Backend**: Laravel
- **Frontend**: Vue 3
- **State-kezelés**: Pinia
- **UI könyvtár**: Vuetify


## Projekt struktúra

### Backend

A backend oldal a klasszikus **Model → Repository → Service → Controller** sémát követi:

- **Model**: Az Eloquent modellek az adatbázis táblákhoz kötődnek.
- **Repository**: Az adatelérést absztrahálja, leválasztva a modellekről.
- **Service**: Az üzleti logika itt kap helyet.
- **Controller**: HTTP kommunikácós réteg ami a service-eket hívja.
- **Serializer**: a HTTP kommunikációs réteg kimenetét formázó megjelenítési réteg.

A rétegek között DTO osztályok közlekednek.

### Frontend

A frontend oldalon az **API → Store → Page → Component** láncolat valósul meg:

- **API**: A backend API-khoz való hozzáférésért felelős fájlok.
- **Store**: A Pinia store-ok kezelik az állapotot és kommunikálnak az API-kkal.
- **Page**: Az oldalszintű komponensek, amelyek meghatározzák az alkalmazás nézeteit.
- **Component**: Újrahasznosítható UI elemek.


## Megjegyzések

- Igyekeztem a Laravel által generált felesleges skeleton fájlokat eltávolítani, hogy a kód tiszta és célorientált maradjon.
- A jelenlegi megoldás kliensoldali szűrést alkalmaz. A szűrést és lapozást ugyanakkor át lehet helyezni szerveroldalra is – ennek ellenére a mostani forma is reményeim szerint jól reprezentálja az általam képviselt elveket.
- A futtatási környezet nem production-ready, a `make dev` parancs (mint a neve is súgalja) kizárólag fejlesztési környezet felállítására alkalmas.

## Szerző

Tasnádi Zsolt

[Teletype.hu](http://teletype.hu)