# debilou-race

![Language](https://img.shields.io/badge/language-Java-ED8B00?style=flat-square&logo=openjdk)
![Paradigm](https://img.shields.io/badge/paradigm-OOP-blue?style=flat-square)

> A Java implementation of a card game featuring deck management, game rules enforcement and player interactions.

---

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Game Rules](#game-rules)
- [Project Structure](#project-structure)
- [Technologies](#technologies)
- [Build & Run](#build--run)

---

## Overview

This project implements a **debilou-race** in Java using object-oriented design. The game models a full deck of cards, handles shuffling and dealing, enforces game rules, manages player turns, and determines the winner.

The focus is on clean OOP design: each entity (Card, Deck, Player, GameEngine) is a distinct class with well-defined responsibilities.

---

## Features

- Standard 52-card deck with suits and ranks
- Deck shuffling (Fisher-Yates algorithm)
- Card dealing to players
- Turn-based game flow
- Rule enforcement and win condition detection
- Multiple player support
- Game state tracking

---

## Game Rules

The game follows classic card game rules:
1. Each player is dealt a hand of cards
2. Players take turns playing cards
3. Rules define valid moves per turn
4. The player who meets the win condition first wins
5. Invalid moves are rejected with an error message

---

## Project Structure

```
card-game-java/
├── src/
│   ├── main/
│   │   ├── CardGame.java       # Entry point
│   │   ├── Card.java           # Card model (suit + rank)
│   │   ├── Deck.java           # Deck: shuffle, deal, draw
│   │   ├── Hand.java           # Player's hand of cards
│   │   ├── Player.java         # Player model
│   │   ├── GameEngine.java     # Game loop and rule enforcement
│   │   └── GameRules.java      # Configurable game rule definitions
│   └── test/
│       └── DeckTest.java       # Unit tests for deck operations
├── pom.xml
└── README.md
```

---

## Technologies

| Technology | Role |
|------------|------|
| Java 17 | Core programming language |
| OOP | Design paradigm |
| Maven | Build and dependency management |
| JUnit 5 | Unit testing |

---

## Build & Run

### Prerequisites

- Java 17+
- Maven 3.x

### Compile and Run

```bash
# Clone the repository
git clone https://github.com/anastasia638/card-game-java.git
cd card-game-java

# Build and run
mvn compile
mvn exec:java -Dexec.mainClass="CardGame"

# Run tests
mvn test
```

---

## Skills Demonstrated

- **Java OOP:** Classes, encapsulation, method design
- **Algorithms:** Deck shuffling, game loop logic
- **Data structures:** Collections for hand and deck management
- **Unit testing:** JUnit for deck operations

---

## Author

**Meriem Silmi** — Computer Science Student, France

[![GitHub](https://img.shields.io/badge/GitHub-anastasia638-black?style=flat-square&logo=github)](https://github.com/anastasia638)
