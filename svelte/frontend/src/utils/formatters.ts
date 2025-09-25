export function formatPrice(price: number, currency: string = '€'): string {
  return `${price.toFixed(2)} ${currency}`;
}

export function formatDate(date: Date): string {
  return date.toLocaleDateString('sk-SK');
}
