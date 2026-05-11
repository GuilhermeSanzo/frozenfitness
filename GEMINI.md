# Frozen Fitness Gourmet - Project Documentation

## Project Overview
Frozen Fitness is a comprehensive e-commerce platform dedicated to selling healthy frozen food. The project features a customer-facing website and a back-office CMS.

---

## 🤖 AI Assistant Directives (CRITICAL)
**Current Stage: Phase 1 - Database Restoration & Stability**

When assisting with this project, the AI (Gemini CLI) MUST strictly adhere to the following rules:

1.  **Atomic Changes Only:** Break down tasks into single, manageable features. Only modify the files explicitly requested.
2.  **NO CODE TRANSLATION (PHASE 1):** Keep all PHP variables, function names, database columns, and file names in their original Portuguese. The logic must remain compatible with the 2016 legacy structure.
3.  **Language Policy:** * **Code & Logic:** Portuguese (for now).
    * **Prompts & Documentation:** English.
    * **Commit Messages:** English.
4.  **Modernization Policy:** In this step, only update database credentials and ensure connectivity. Do not upgrade to PDO yet unless explicitly commanded.

---

## Refactoring Roadmap
- [x] **Step 1:** Rollback to initial 2016 commit.
- [x] **Step 2:** Fix database connection logic to work in the local environment (current task).
- [ ] **Step 3:** Modernize infrastructure using PDO and Prepared Statements (maintaining Portuguese names).
- [ ] **Step 4:** Full English migration (code, database aliases, and files).

## Refactoring Ledger

### Step 2: Database Restoration
- **Local Credentials:** Updated `php/geral.php` and `cms/php/geral.php` to use standard local environment settings:
    - **User:** `root`
    - **Password:** (empty)
    - **Database:** `frozenfitness`