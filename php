import { useState } from "react";
import { LineChart, Line, XAxis, YAxis, Tooltip, CartesianGrid, ResponsiveContainer } from "recharts";
import { Card, CardContent } from "@/components/ui/card";
import { Button } from "@/components/ui/button";

const energyData = [
  { day: "Sen", energy: 20 },
  { day: "Sel", energy: 25 },
  { day: "Rab", energy: 18 },
  { day: "Kam", energy: 22 },
  { day: "Jum", energy: 30 },
  { day: "Sab", energy: 28 },
  { day: "Min", energy: 24 },
];

export default function Dashboard() {
  const [status, setStatus] = useState("Normal");

  return (
    <div className="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <Card>
        <CardContent className="p-4">
          <h2 className="text-xl font-semibold">Status Sistem</h2>
          <p className={`text-lg font-bold ${status === "Normal" ? "text-green-500" : "text-red-500"}`}>{status}</p>
          <Button onClick={() => setStatus(status === "Normal" ? "Gangguan" : "Normal")} className="mt-2">Ubah Status</Button>
        </CardContent>
      </Card>
      
      <Card>
        <CardContent className="p-4">
          <h2 className="text-xl font-semibold">Produksi Energi (kWh)</h2>
          <ResponsiveContainer width="100%" height={250}>
            <LineChart data={energyData}>
              <XAxis dataKey="day" />
              <YAxis />
              <Tooltip />
              <CartesianGrid stroke="#ccc" />
              <Line type="monotone" dataKey="energy" stroke="#4CAF50" strokeWidth={2} />
            </LineChart>
          </ResponsiveContainer>
        </CardContent>
      </Card>
    </div>
  );
}
