// src/types/ui.ts
export interface NavigationItem {
  name: string;
  href: string;
  route: string;
  icon?: string;
  children?: NavigationItem[];
}

export interface HeaderProps {
  currentRoute: string;
  searchQuery: string;
  navigation?: NavigationItem[];
  onSearch?: (query: string) => void;
  onMobileMenuToggle?: () => void;
  onSearchToggle?: () => void;
}

export interface SearchModalProps {
  isOpen: boolean;
  searchQuery: string;
  onClose: () => void;
  onSearch: (query: string) => void;
}

export interface MobileMenuProps {
  isOpen: boolean;
  navigation: NavigationItem[];
  currentRoute: string;
  onClose: () => void;
  onNavClick: (route: string) => void;
}

export interface NavigationProps {
  navigation: NavigationItem[];
  currentRoute: string;
  isMobile?: boolean;
  onNavClick?: (route: string) => void;
}
