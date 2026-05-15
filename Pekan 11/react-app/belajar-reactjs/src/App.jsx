
import { useState } from 'react';
import ActivityItem from './ActivityItem';
import './App.css';

function App() {

  const [activities, setActivities] = useState([]);
  

  const [inputValue, setInputValue] = useState('');


  const handleAddActivity = (e) => {
    e.preventDefault();
    if (inputValue.trim() === '') return;

    const newActivity = {
      id: Date.now(), 
      name: inputValue
    };

    setActivities([...activities, newActivity]);
    setInputValue(''); 
  };

  const handleDeleteActivity = (id) => {
    const filteredActivities = activities.filter((activity) => activity.id !== id);
    setActivities(filteredActivities);
  };

  return (
    <div className="app-container">
      <h1>Daftar Aktivitas Mahasiswa</h1>
      
      <form onSubmit={handleAddActivity} className="input-form">
        <input
          type="text"
          placeholder="Masukkan nama aktivitas..."
          value={inputValue}
          onChange={(e) => setInputValue(e.target.value)}
        />
        <button type="submit" className="btn-add">Tambah</button>
      </form>

      {activities.length === 0 ? (
        <p className="empty-message">Belum ada aktivitas</p>
      ) : (
        <ul className="activity-list">
          {activities.map((activity) => (
            <ActivityItem 
              key={activity.id} 
              activity={activity} 
              onDelete={handleDeleteActivity} 
            />
          ))}
        </ul>
      )}
    </div>
  );
}

export default App;