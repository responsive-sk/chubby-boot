interface AppState {
  user: User | null;
  cart: CartItem[];
  theme: 'light' | 'dark';
}

interface CartItem {
  id: string;
  name: string;
  price: number;
  quantity: number;
}
