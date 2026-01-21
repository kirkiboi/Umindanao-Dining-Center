import React from "react";

export default function DashboardTable() {
    const data = [
        { id: 1, name: "Chicken Adobo", price: 120, category: "Main" },
        { id: 2, name: "Spaghetti", price: 90, category: "Pasta" },
        { id: 3, name: "Burger", price: 80, category: "Snack" },
    ];

    return (
        <div className="p-6">
            <h1 className="text-2xl font-bold mb-4">Menu Dashboard</h1>
            <table className="min-w-full bg-white shadow-lg rounded-lg overflow-hidden">
                <thead className="bg-gray-200">
                    <tr>
                        <th className="px-6 py-3 text-left font-semibold">ID</th>
                        <th className="px-6 py-3 text-left font-semibold">Name</th>
                        <th className="px-6 py-3 text-left font-semibold">Price</th>
                        <th className="px-6 py-3 text-left font-semibold">Category</th>
                    </tr>
                </thead>
                <tbody>
                    {data.map((row) => (
                        <tr key={row.id} className="border-b hover:bg-gray-100">
                            <td className="px-6 py-3">{row.id}</td>
                            <td className="px-6 py-3">{row.name}</td>
                            <td className="px-6 py-3">₱{row.price}</td>
                            <td className="px-6 py-3">{row.category}</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}