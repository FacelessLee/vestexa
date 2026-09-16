import React, { useEffect } from 'react';
import { BrowserRouter } from 'react-router-dom';
import { AuthProvider } from './context/AuthContext';
import { AppRouter } from './router';
import { seedDemoData } from './lib/seedData';
import { processRoiAccruals } from './lib/roiEngine';

// Seed demo data on first load
seedDemoData();

export function App() {
  useEffect(() => {
    // Check and process scheduled ROI accruals on startup and every 60s
    processRoiAccruals();
    const interval = setInterval(() => {
      processRoiAccruals();
    }, 60000);
    return () => clearInterval(interval);
  }, []);

  return (
    <BrowserRouter>
      <AuthProvider>
        <AppRouter />
      </AuthProvider>
    </BrowserRouter>
  );
}

export default App;

