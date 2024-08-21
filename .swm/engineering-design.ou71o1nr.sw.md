---
title: Engineering design
---
## References

- Other relevant documents
- Link to PRD

## Goals

Main KPIs of this feature

## High level design

- {{Flow chart, like this one}}

```mermaid
sequenceDiagram
Service A->>+Service B: GET /objects/{id}

Service B-->>Service A: 200 OK (object)
Service A->>+Service C: GET /data/{object_internal_id}
Service C-->>Service A: 200 OK
```

- DB changes
- UI components
- What is stored (e.g., in the state, local storage...)

## Third party integrations

- Logs
- Analytics

## Tests to be added

## Migrations

## Security implications

## Roll-out plan

<SwmMeta version="3.0.0" repo-id="Z2l0aHViJTNBJTNBdW5pdmFsaSUzQSUzQUNlbHNvY3c=" repo-name="univali"><sup>Powered by [Swimm](https://app.swimm.io/)</sup></SwmMeta>
