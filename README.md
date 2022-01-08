# Desafio PHP

This little PHP CLI application is to attend simple use cases, for demonstration only.

## Requirements

[Docker](https://www.docker.com/) and [Docker-compose](https://docs.docker.com/compose/install/) pre-installed.

## Environment

### Build

```bash
docker-compose up -d
```
### Access

```bash
docker-compose exec desafio-php bash
```
## Usage 
### Commands

Create a new user with Firstname, Lastname, Email and Age (optional).

```bash
USER:CREATE <firstname> <lastname> <email> [<age>]
```
| Arguments | Required | Default |
|-----------|----------|---------|
| firstname | yes      |         |
| lastname  | yes      |         |
| email     | yes      |         |
| age       | no       | null    |  

Define a password for a previously created user with Password and Password Confirmation arguments.
The User's ID is required to execute this action.

```bash
USER:CREATE-PWD <id> <password> <confirmation>
```
| Arguments    | Required |
|--------------|----------|
| id           | yes      |
| password     | yes      |
| confirmation | yes      |

### Examples

```bash
./ASP-TEST USER:CREATE John Doe johndoe@email.com 45

# output
User created: {"id":"1","firstname":"John","lastname":"Doe","email":"johndoe@email.com","age":"45","pass":null}
```

```bash
./ASP-TEST USER:CREATE-PWD 1 P@ssw0rd P@ssw0rd

# output
Password created: {"id":"1","firstname":"John","lastname":"Doe","email":"johndoe@email.com","age":"45","pass":"$2y$10$.biPMY3LjHcXyog\/JFmABunxU.UhLjJ5NZixRfT1e4Ae0HIRLJPea"}
```
Author Information
------------------

[sidneytougeiro@msn.com](mailto:sidneytougeiro@msn.com)