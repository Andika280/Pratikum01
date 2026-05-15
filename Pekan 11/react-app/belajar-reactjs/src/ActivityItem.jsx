function ActivityItem({ activity, onDelete }) {
  return (
    <li className="activity-item">
      <span>{activity.name}</span>
      <button className="btn-delete" onClick={() => onDelete(activity.id)}>
        Hapus
      </button>
    </li>
  );
}

export default ActivityItem;