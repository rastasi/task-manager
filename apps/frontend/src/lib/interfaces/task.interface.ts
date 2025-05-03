import { User } from "./user.interface";

export interface Task {
    description: string;
    user_id: number;
    user?: User;
    estimated_time: number;
    used_time: number;
    id: number;
    completed_at: string;
    selected: boolean;
}