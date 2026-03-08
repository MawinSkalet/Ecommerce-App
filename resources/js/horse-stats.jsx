import React from 'react';
import { createRoot } from 'react-dom/client';
import HorseStatsChart from './components/HorseStatsChart.jsx';

// Mount all horse stat charts on the page
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-horse-stats]').forEach((el) => {
        const horseId = parseInt(el.dataset.horseId, 10);
        const horseName = el.dataset.horseName || 'Horse';
        const stats = {
            speed: parseInt(el.dataset.statSpeed, 10) || 300,
            stamina: parseInt(el.dataset.statStamina, 10) || 300,
            power: parseInt(el.dataset.statPower, 10) || 300,
            guts: parseInt(el.dataset.statGuts, 10) || 300,
            wisdom: parseInt(el.dataset.statWisdom, 10) || 300,
        };
        const root = createRoot(el);
        root.render(<HorseStatsChart horseId={horseId} horseName={horseName} stats={stats} />);
    });
});
