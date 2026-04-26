# InvestFlow - Mini Investment Onboarding & Transaction Flow

InvestFlow is a high-fidelity demonstration of a cross-border investment platform onboarding journey. It features a premium, dark-themed user interface with glassmorphism aesthetics, secure compliance checks, and a transparent investment audit trail.

## 🚀 Features
- **Premium Onboarding**: Multi-field registration with instant account creation.
- **Identity Verification (KYC)**: Simulated biometric and document checks with randomized failure/pending states to demonstrate error handling.
- **Investor Accreditation**: Verification flow matching SEC standards for accredited investors.
- **Financial Integration**: Link multiple bank accounts (simulated) and manage balances.
- **Escrow Transactions**: Secure investment flow into a Law Firm Escrow Account with detailed receipting.
- **Security Audit Trail**: Every critical action is logged with status and timestamps for transparency.
- **CI/CD Integration**: Automated testing and deployment pipeline via GitHub Actions.

---

## 🏗️ Architecture Decisions

### 1. Framework: Laravel 12
Chosen for its robust MVC architecture, elegant routing, and built-in security features. Laravel's Blade engine allowed for the creation of a sophisticated design system without the overhead of a heavy SPA framework.

### 2. Service Logic & Mocks
**Design Choice**: For this demo, mock logic for KYC and Accreditation is handled within specialized Controllers to keep the codebase compact and easy to audit. 
**Scalability Note**: In a production-grade system, we would move this logic into a **Service Pattern** (e.g., `ComplianceService`), allowing for easy hot-swapping between the mock and a real provider like Shufti Pro or Plaid.

### 3. Persistence: MySQL
The application is configured to use MySQL for production-grade data persistence, supporting complex relationships between users, bank accounts, transactions, and audit logs.

---

## ⚖️ Trade-offs

- **Happy Path Prioritization**: 
    - *Decision*: Prioritized the "Happy Path" (successful onboarding to investment) to showcase the premium user experience.
    - *Trade-off*: Complex edge cases (e.g., multi-step AML appeals or manual document review queues) are mocked as "Pending" or "Failure" rather than fully built out to maintain focus on the core transaction flow.
- **Tailwind CDN vs. Vite Build**: 
    - *Decision*: Used the Tailwind JIT CDN for the demo.
    - *Trade-off*: Slightly slower initial page load in exchange for faster development and easier portability without an `npm` build step.

---

## 📝 Assumptions
- **Investor Eligibility**: We assumed that the user's **Domicile** is the primary driver for accreditation. For the purpose of this mock, any user providing a valid "Verification Payload" is eligible for accreditation, bypassing complex cross-border regulatory differences.
- **Law Firm Escrow Account**: Assumed that in a cross-border context, users value the security of a legal intermediary. This is integrated as a trust anchor in the final transaction step.

---

## 🛠️ Setup Instructions

1. **Clone the Repo**:
   ```bash
   git clone https://github.com/PoojaMane-00/investment-flow.git
   cd investment-flow
   ```

2. **Install Dependencies**:
   ```bash
   composer install
   ```

3. **Environment Setup**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Note: Update `.env` with your MySQL credentials.*

4. **Database Migration**:
   ```bash
   php artisan migrate
   ```

5. **Run the Server**:
   ```bash
   php artisan serve
   ```
   Visit: [http://localhost:8000](http://localhost:8000)

---

**Driven by ❤️ for challenging tasks. | Developed by Pooja Mane**
