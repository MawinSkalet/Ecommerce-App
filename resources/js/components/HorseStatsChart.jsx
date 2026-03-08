import React, { useMemo } from 'react';
import {
    RadarChart,
    PolarGrid,
    PolarAngleAxis,
    PolarRadiusAxis,
    Radar,
    ResponsiveContainer,
    Tooltip,
} from 'recharts';

// Build stats array from props
function buildStats(stats) {
    return [
        { stat: 'Speed', value: stats.speed, fullMark: 1200 },
        { stat: 'Stamina', value: stats.stamina, fullMark: 1200 },
        { stat: 'Power', value: stats.power, fullMark: 1200 },
        { stat: 'Guts', value: stats.guts, fullMark: 1200 },
        { stat: 'Wisdom', value: stats.wisdom, fullMark: 1200 },
    ];
}

// Letter rank based on stat value
function getRank(value) {
    if (value >= 1100) return 'S+';
    if (value >= 1000) return 'S';
    if (value >= 900) return 'A+';
    if (value >= 800) return 'A';
    if (value >= 700) return 'B+';
    if (value >= 600) return 'B';
    if (value >= 500) return 'C+';
    if (value >= 400) return 'C';
    return 'D';
}

function getRankColor(value) {
    if (value >= 1000) return '#f59e0b'; // Gold
    if (value >= 800) return '#ef4444';  // Red
    if (value >= 600) return '#3b82f6';  // Blue
    if (value >= 400) return '#22c55e';  // Green
    return '#9ca3af';                    // Gray
}

const CustomTooltip = ({ active, payload }) => {
    if (active && payload && payload.length) {
        const data = payload[0].payload;
        return (
            <div className="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg px-3 py-2">
                <p className="font-bold text-gray-900 dark:text-white text-sm">{data.stat}</p>
                <p className="text-indigo-600 dark:text-indigo-400 font-mono font-bold">
                    {data.value} <span style={{ color: getRankColor(data.value) }}>({getRank(data.value)})</span>
                </p>
            </div>
        );
    }
    return null;
};

export default function HorseStatsChart({ horseId, horseName, stats: rawStats }) {
    const stats = useMemo(() => buildStats(rawStats), [rawStats]);
    const totalPower = useMemo(() => stats.reduce((sum, s) => sum + s.value, 0), [stats]);

    return (
        <div className="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
            <div className="flex items-center justify-between mb-2">
                <h3 className="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <span>⚡</span> Attributes
                </h3>
                <span className="text-sm font-mono bg-indigo-100 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-300 px-3 py-1 rounded-full font-bold">
                    Total: {totalPower}
                </span>
            </div>
            <p className="text-xs text-gray-500 dark:text-gray-400 mb-4">Uma Musume-style racing attributes</p>

            <ResponsiveContainer width="100%" height={300}>
                <RadarChart data={stats} cx="50%" cy="50%" outerRadius="75%">
                    <PolarGrid stroke="#e5e7eb" strokeDasharray="3 3" />
                    <PolarAngleAxis
                        dataKey="stat"
                        tick={{ fill: '#6b7280', fontSize: 12, fontWeight: 600 }}
                    />
                    <PolarRadiusAxis
                        angle={90}
                        domain={[0, 1200]}
                        tick={{ fill: '#9ca3af', fontSize: 10 }}
                        tickCount={5}
                    />
                    <Radar
                        name={horseName}
                        dataKey="value"
                        stroke="#6366f1"
                        fill="#6366f1"
                        fillOpacity={0.25}
                        strokeWidth={2}
                    />
                    <Tooltip content={<CustomTooltip />} />
                </RadarChart>
            </ResponsiveContainer>

            {/* Stat bars */}
            <div className="space-y-2 mt-4">
                {stats.map((s) => (
                    <div key={s.stat} className="flex items-center gap-3">
                        <span className="text-xs font-semibold text-gray-600 dark:text-gray-400 w-16">{s.stat}</span>
                        <div className="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-2.5 overflow-hidden">
                            <div
                                className="h-full rounded-full transition-all duration-500"
                                style={{
                                    width: `${(s.value / 1200) * 100}%`,
                                    backgroundColor: getRankColor(s.value),
                                }}
                            />
                        </div>
                        <span className="text-xs font-mono font-bold w-8 text-right" style={{ color: getRankColor(s.value) }}>
                            {getRank(s.value)}
                        </span>
                        <span className="text-xs font-mono text-gray-500 dark:text-gray-400 w-10 text-right">{s.value}</span>
                    </div>
                ))}
            </div>
        </div>
    );
}
