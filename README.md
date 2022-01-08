# Desafio PHP

This little PHP CLI application is to attend simple use cases, for demonstration only.

## Requirements

[Docker](https://www.docker.com/) pre-installed.

## Commands

```bash
USER:CREATE <firstname> <lastname> <email> [<age>]
```
| Arguments | Required | Default |
|-----------|----------|---------|
| firstname | yes      |         |
| lastname  | yes      |         |
| email     | yes      |         |
| age       | no       | null    |  

```bash
USER:CREATE-PWD <id> <password> <confirmation>
```
| Arguments    | Required |
|--------------|----------|
| id           | yes      |
| password     | yes      |
| confirmation | yes      |

Example
-------

Including an example of how to use your role (for instance, with variables passed in as parameters) is always nice for users too:

    - hosts: all
      roles:
         - ansible-role-template


Author Information
------------------

[sidneytougeiro@msn.com](mailto:sidneytougeiro@msn.com)