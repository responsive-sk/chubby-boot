import { writable } from 'svelte/store';

interface CartItem {
  id: string;
  name: string;
  price: number;
  quantity: number;
}

interface Cart {
  items: CartItem[];
  total: number;
}

// Cart management
export const cartStore = writable<Cart>({
  items: [],
  total: 0
});

export function addToCart(item: CartItem) {
  cartStore.update(cart => {
    cart.items.push(item);
    cart.total += item.price * item.quantity;
    return cart;
  });
}

export function removeFromCart(itemId: string) {
  cartStore.update(cart => {
    const index = cart.items.findIndex(item => item.id === itemId);
    if (index !== -1) {
      cart.total -= cart.items[index].price * cart.items[index].quantity;
      cart.items.splice(index, 1);
    }
    return cart;
  });
}
