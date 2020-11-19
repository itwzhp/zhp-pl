import { shallowMount } from '@vue/test-utils';
import ZTable from './ZTable.vue';

describe('ZTable.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZTable);
    expect(component.get('.z-table'));
  });
});
