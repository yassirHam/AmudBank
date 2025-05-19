<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Horizon - Tableau de bord bancaire</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary: #2563eb;
      --primary-light: #3b82f6;
      --secondary: #64748b;
      --success: #10b981;
      --danger: #ef4444;
      --warning: #f59e0b;
      --dark: #1e293b;
      --light: #f8fafc;
      --gray: #e2e8f0;
      --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      background: #f1f5f9;
      color: #334155;
      line-height: 1.5;
    }

    .container {
      display: flex;
      min-height: 100vh;
    }

    /* Sidebar amélioré */
    .sidebar {
      width: 280px;
      background: white;
      padding: 1.5rem;
      box-shadow: var(--card-shadow);
      position: relative;
      z-index: 10;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin-bottom: 2.5rem;
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--dark);
    }

    .logo-icon {
      color: var(--primary);
      font-size: 1.75rem;
    }

    .nav {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .nav-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.75rem 1rem;
      border-radius: 0.5rem;
      cursor: pointer;
      transition: all 0.2s ease;
      color: var(--secondary);
      text-decoration: none;
    }

    .nav-item i {
      width: 24px;
      text-align: center;
    }

    .nav-item:hover {
      background: #f1f5f9;
      color: var(--primary);
    }

    .nav-item.active {
      background: var(--primary);
      color: white;
    }

    .nav-item.active:hover {
      background: var(--primary-light);
    }

    /* Contenu principal */
    .main-content {
      flex: 1;
      padding: 2rem;
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .welcome h1 {
      font-size: 1.75rem;
      margin-bottom: 0.5rem;
    }

    .highlight {
      color: var(--primary);
    }

    .search-bar {
      display: flex;
      align-items: center;
      background: white;
      padding: 0.75rem 1rem;
      border-radius: 0.5rem;
      width: 300px;
      box-shadow: var(--card-shadow);
    }

    .search-bar input {
      border: none;
      outline: none;
      flex: 1;
      padding: 0 0.5rem;
    }

    .search-bar i {
      color: var(--secondary);
    }

    /* Cartes de synthèse */
    .summary-cards {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.5rem;
    }

    .card {
      background: white;
      border-radius: 0.75rem;
      padding: 1.5rem;
      box-shadow: var(--card-shadow);
    }

    .card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
    }

    .card-title {
      font-size: 0.875rem;
      color: var(--secondary);
      font-weight: 500;
    }

    .card-value {
      font-size: 1.75rem;
      font-weight: 700;
    }

    .card-change {
      display: flex;
      align-items: center;
      gap: 0.25rem;
      font-size: 0.875rem;
    }

    .positive {
      color: var(--success);
    }

    .negative {
      color: var(--danger);
    }

    /* Graphique */
    .chart-container {
      height: 250px;
      background: white;
      border-radius: 0.75rem;
      padding: 1.5rem;
      box-shadow: var(--card-shadow);
      position: relative;
    }

    .chart-placeholder {
      width: 100%;
      height: 100%;
      background: #f8fafc;
      border-radius: 0.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--secondary);
    }

    /* Transactions */
    .transactions {
      background: white;
      border-radius: 0.75rem;
      padding: 1.5rem;
      box-shadow: var(--card-shadow);
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .section-title {
      font-size: 1.25rem;
      font-weight: 600;
    }

    .tabs {
      display: flex;
      gap: 0.5rem;
      background: #f1f5f9;
      padding: 0.25rem;
      border-radius: 0.5rem;
    }

    .tab {
      padding: 0.5rem 1rem;
      border-radius: 0.25rem;
      cursor: pointer;
      font-size: 0.875rem;
      font-weight: 500;
      transition: all 0.2s ease;
    }

    .tab.active {
      background: white;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 1rem;
      text-align: left;
      border-bottom: 1px solid #f1f5f9;
    }

    th {
      font-size: 0.75rem;
      color: var(--secondary);
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    .transaction {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .transaction-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #f1f5f9;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--primary);
    }

    .transaction-details {
      display: flex;
      flex-direction: column;
      gap: 0.25rem;
    }

    .transaction-name {
      font-weight: 500;
    }

    .transaction-category {
      font-size: 0.75rem;
      color: var(--secondary);
    }

    .status {
      display: inline-flex;
      align-items: center;
      gap: 0.25rem;
      padding: 0.25rem 0.5rem;
      border-radius: 1rem;
      font-size: 0.75rem;
      font-weight: 500;
    }

    .status.success {
      background: #dcfce7;
      color: var(--success);
    }

    .status.pending {
      background: #fef9c3;
      color: var(--warning);
    }

    /* Panneau droit */
    .right-panel {
      width: 320px;
      padding: 2rem;
      background: white;
      box-shadow: -2px 0 10px rgba(0, 0, 0, 0.05);
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }

    .profile {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .avatar {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: var(--primary);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
    }

    .profile-info h4 {
      font-weight: 600;
    }

    .profile-info p {
      font-size: 0.875rem;
      color: var(--secondary);
    }

    /* Carte bancaire */
    .bank-card {
      background: linear-gradient(135deg, var(--primary), var(--primary-light));
      color: white;
      padding: 1.5rem;
      border-radius: 1rem;
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .card-chip {
      width: 40px;
      height: 30px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 0.25rem;
    }

    .card-number {
      font-family: 'Courier New', monospace;
      letter-spacing: 0.1em;
      font-size: 1.1rem;
      margin: 0.5rem 0;
    }

    .card-footer {
      display: flex;
      justify-content: space-between;
    }

    .card-details {
      display: flex;
      flex-direction: column;
      gap: 0.25rem;
    }

    .card-label {
      font-size: 0.75rem;
      opacity: 0.8;
    }

    /* Catégories */
    .category {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      margin-bottom: 1rem;
    }

    .category-header {
      display: flex;
      justify-content: space-between;
    }

    .category-name {
      font-weight: 500;
    }

    .category-amount {
      font-weight: 600;
    }

    .progress-bar {
      height: 8px;
      width: 100%;
      background: #f1f5f9;
      border-radius: 1rem;
      overflow: hidden;
    }

    .progress {
      height: 100%;
      border-radius: 1rem;
    }

    .progress-travel {
      background: var(--success);
      width: 65%;
    }

    .progress-food {
      background: var(--danger);
      width: 45%;
    }

    .progress-shopping {
      background: var(--warning);
      width: 30%;
    }

    /* Bouton flottant */
    .fab {
      position: fixed;
      bottom: 2rem;
      right: 2rem;
      width: 56px;
      height: 56px;
      border-radius: 50%;
      background: var(--primary);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .fab:hover {
      background: var(--primary-light);
      transform: translateY(-2px);
    }
  </style>
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <div class="logo">
        <div class="logo-icon">◆</div>
        <span>Horizon</span>
      </div>
      <nav class="nav">
        <a href="#" class="nav-item active">
          <i class="fas fa-home"></i>
          <span>Accueil</span>
        </a>
        <a href="#" class="nav-item">
          <i class="fas fa-landmark"></i>
          <span>Mes comptes</span>
        </a>
        <a href="#" class="nav-item">
          <i class="fas fa-exchange-alt"></i>
          <span>Transactions</span>
        </a>
        <a href="#" class="nav-item">
          <i class="fas fa-money-bill-wave"></i>
          <span>Virements</span>
        </a>
        <a href="#" class="nav-item">
          <i class="fas fa-chart-pie"></i>
          <span>Budget</span>
        </a>
        <a href="#" class="nav-item">
          <i class="fas fa-cog"></i>
          <span>Paramètres</span>
        </a>
      </nav>
    </aside>

    <main class="main-content">
      <header class="header">
        <div class="welcome">
          <h1>Bonjour, <span class="highlight">Adrian</span></h1>
          <p>Voici votre activité récente</p>
        </div>
        <div class="search-bar">
          <i class="fas fa-search"></i>
          <input type="text" placeholder="Rechercher...">
        </div>
      </header>

      <div class="summary-cards">
        <div class="card">
          <div class="card-header">
            <span class="card-title">Solde total</span>
            <i class="fas fa-wallet"></i>
          </div>
          <div class="card-value">€8,245.50</div>
          <div class="card-change positive">
            <i class="fas fa-arrow-up"></i>
            <span>12% ce mois</span>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <span class="card-title">Dépenses</span>
            <i class="fas fa-shopping-bag"></i>
          </div>
          <div class="card-value">€1,245.30</div>
          <div class="card-change negative">
            <i class="fas fa-arrow-down"></i>
            <span>5% ce mois</span>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <span class="card-title">Économies</span>
            <i class="fas fa-piggy-bank"></i>
          </div>
          <div class="card-value">€3,500.00</div>
          <div class="card-change positive">
            <i class="fas fa-arrow-up"></i>
            <span>8% ce mois</span>
          </div>
        </div>
      </div>

      <div class="chart-container">
        <div class="section-header">
          <h3 class="section-title">Activité mensuelle</h3>
          <select class="tab">
            <option>Ce mois</option>
            <option>3 mois</option>
            <option>6 mois</option>
            <option>12 mois</option>
          </select>
        </div>
        <div class="chart-placeholder">
          <i class="fas fa-chart-line" style="font-size: 2rem; margin-right: 0.5rem;"></i>
          <span>Graphique d'activité</span>
        </div>
      </div>

      <section class="transactions">
        <div class="section-header">
          <h3 class="section-title">Dernières transactions</h3>
          <div class="tabs">
            <div class="tab active">Tous</div>
            <div class="tab">Dépenses</div>
            <div class="tab">Revenus</div>
          </div>
        </div>
        <table>
          <thead>
            <tr>
              <th>Transaction</th>
              <th>Montant</th>
              <th>Statut</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <div class="transaction">
                  <div class="transaction-icon">
                    <i class="fas fa-plane"></i>
                  </div>
                  <div class="transaction-details">
                    <div class="transaction-name">Air France</div>
                    <div class="transaction-category">Voyage</div>
                  </div>
                </div>
              </td>
              <td class="negative">-€450.00</td>
              <td><span class="status success">Complété</span></td>
              <td>Aujourd'hui, 10:45</td>
            </tr>
            <tr>
              <td>
                <div class="transaction">
                  <div class="transaction-icon">
                    <i class="fas fa-utensils"></i>
                  </div>
                  <div class="transaction-details">
                    <div class="transaction-name">Restaurant Le Petit</div>
                    <div class="transaction-category">Nourriture</div>
                  </div>
                </div>
              </td>
              <td class="negative">-€85.30</td>
              <td><span class="status success">Complété</span></td>
              <td>Hier, 19:30</td>
            </tr>
            <tr>
              <td>
                <div class="transaction">
                  <div class="transaction-icon">
                    <i class="fas fa-money-bill-wave"></i>
                  </div>
                  <div class="transaction-details">
                    <div class="transaction-name">Salaire</div>
                    <div class="transaction-category">Revenu</div>
                  </div>
                </div>
              </td>
              <td class="positive">+€3,200.00</td>
              <td><span class="status success">Complété</span></td>
              <td>28 mai 2023</td>
            </tr>
            <tr>
              <td>
                <div class="transaction">
                  <div class="transaction-icon">
                    <i class="fas fa-shopping-bag"></i>
                  </div>
                  <div class="transaction-details">
                    <div class="transaction-name">Amazon</div>
                    <div class="transaction-category">Shopping</div>
                  </div>
                </div>
              </td>
              <td class="negative">-€120.99</td>
              <td><span class="status pending">En attente</span></td>
              <td>26 mai 2023</td>
            </tr>
          </tbody>
        </table>
      </section>
    </main>

    <aside class="right-panel">
      <div class="profile">
        <div class="avatar">A</div>
        <div class="profile-info">
          <h4>Adrian Hajdin</h4>
          <p>adrian@jsmastery.pro</p>
        </div>
      </div>

      <div class="bank-card">
        <div class="card-chip"></div>
        <div class="card-number">•••• •••• •••• 4679</div>
        <div class="card-footer">
          <div class="card-details">
            <span class="card-label">Titulaire de carte</span>
            <span>Adrian Hajdin</span>
          </div>
          <div class="card-details">
            <span class="card-label">Expire le</span>
            <span>09/25</span>
          </div>
        </div>
      </div>

      <div class="top-categories">
        <h3 class="section-title">Catégories principales</h3>
        <div class="category">
          <div class="category-header">
            <span class="category-name">Voyage</span>
            <span class="category-amount">€650.00</span>
          </div>
          <div class="progress-bar">
            <div class="progress progress-travel"></div>
          </div>
        </div>
        <div class="category">
          <div class="category-header">
            <span class="category-name">Nourriture</span>
            <span class="category-amount">€450.30</span>
          </div>
          <div class="progress-bar">
            <div class="progress progress-food"></div>
          </div>
        </div>
        <div class="category">
          <div class="category-header">
            <span class="category-name">Shopping</span>
            <span class="category-amount">€320.99</span>
          </div>
          <div class="progress-bar">
            <div class="progress progress-shopping"></div>
          </div>
        </div>
      </div>
    </aside>

    <div class="fab">
      <i class="fas fa-plus"></i>
    </div>
  </div>
</body>
</html>